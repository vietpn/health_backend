<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateOrderAPIRequest;
use App\Http\Requests\API\UpdateOrderAPIRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\Api\OrderDetailRepository;
use App\Repositories\Api\OrderRepository;
use App\Repositories\Api\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OrderController
 * @package App\Http\Controllers\API\Api
 */
class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;
    private $productRepository;
    private $orderDetailRepository;

    public function __construct(OrderRepository $orderRepo, ProductRepository $productRepo, OrderDetailRepository $orderDetailRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->productRepository = $productRepo;
        $this->orderDetailRepository = $orderDetailRepo;
    }

    /**
     * Display a listing of the Order.
     * GET|HEAD /orders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $profile = \Auth::user();

        $this->orderRepository->pushCriteria(new RequestCriteria($request));
        $this->orderRepository->pushCriteria(new LimitOffsetCriteria($request));
        $orders = $this->orderRepository->findByField('profile_id', $profile->id);

        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
    }

    /**
     * Store a newly created Order in storage.
     * POST /orders
     *
     * @param CreateOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderAPIRequest $request)
    {
        $profile = \Auth::user();

        $input = $request->all();
        $input['profile_id'] = $profile->id;

        $orders = $this->orderRepository->create($input);
        $order_details = array();
        if (!empty($input['order_detail'])) {
            $details = json_decode($input['order_detail'], true);
            if ($details) {
                foreach ($details as $detail) {
                    if (isset($detail['product_id']) && isset($detail['amount'])) {
                        $order_detail = new OrderDetail();
                        $order_detail->product_id = $detail['product_id'];
                        $order_detail->amount = $detail['amount'];
                        $order_detail->order_id = $orders->id;
                        $order_detail->save();
                        $order_details[] = $order_detail->toArray();

                        // reduce product amount
                        $product = $this->productRepository->findWithoutFail($detail['product_id']);
                        if (!empty($product)) {
                            $input = array();
                            $amount = $product->amount - $detail['amount'];
                            $amount = ($amount > 0) ? $amount : 0;
                            $input['amount'] = $amount;
                            $this->productRepository->update($input, $detail['product_id']);
                        }
                    }
                }
            }
        }
        $orders['order_detail'] = $order_details;

        return $this->sendResponse($orders->toArray(), 'Order saved successfully');
    }

    /**
     * Display the specified Order.
     * GET|HEAD /orders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        $order['order_detail'] = $order->orderDetail()->get();

        return $this->sendResponse($order->toArray(), 'Order retrieved successfully');
    }

    /**
     * Update the specified Order in storage.
     * PUT/PATCH /orders/{id}
     *
     * @param  int $id
     * @param UpdateOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);
        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        // update order
        $order = $this->orderRepository->update($input, $id);

        // delete all order detail
        $this->orderDetailRepository->deleteWhere(array('order_id' => $order->id));

        // update order detail
        $order_details = array();
        if (!empty($input['order_detail'])) {
            $details = json_decode($input['order_detail'], true);
            if ($details) {
                foreach ($details as $detail) {
                    if (isset($detail['product_id']) && isset($detail['amount'])) {
                        $order_detail = new OrderDetail();
                        $order_detail->product_id = $detail['product_id'];
                        $order_detail->amount = $detail['amount'];
                        $order_detail->order_id = $order->id;
                        $order_detail->save();
                        $order_details[] = $order_detail->toArray();
                    }
                }
            }
        }

        $order['order_detail'] = $order->orderDetail()->get();

        return $this->sendResponse($order->toArray(), 'Order updated successfully');
    }

    /**
     * Remove the specified Order from storage.
     * DELETE /orders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        $order->delete();

        return $this->sendResponse($id, 'Order deleted successfully');
    }
}
