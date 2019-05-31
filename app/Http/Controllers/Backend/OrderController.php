<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateOrderRequest;
use App\Http\Requests\Backend\UpdateOrderRequest;
use App\Repositories\Backend\OrderDetailRepository;
use App\Repositories\Backend\OrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;
    private $orderDetailRepository;

    public function __construct(OrderRepository $orderRepo, OrderDetailRepository $orderDetailRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->orderDetailRepository = $orderDetailRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->orderRepository->pushCriteria(new RequestCriteria($request));

        $query = DB::table('e_order')
            ->orderBy('e_order.id', 'DESC')
            ->leftJoin('e_profile', 'e_profile.id', '=', 'e_order.profile_id')
            ->select('e_order.*', 'e_profile.username');

        // pagination
        $orders = $query->paginate(10);

        return view('backend.orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.orders.create');
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        Flash::success('Order saved successfully.');

        return redirect(route('backend.orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $query = DB::table('e_order')
            ->leftJoin('e_profile', 'e_profile.id', '=', 'e_order.profile_id')
            ->select('e_order.*', 'e_profile.username')
            ->where('e_order.id', '=', $id);
        $order = $query->first();

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('backend.orders.index'));
        }

        $orderDetails = $this->orderDetailRepository->findByField('order_id', $id);

        return view('backend.orders.show')
            ->with('order', $order)
            ->with('orderDetails', $orderDetails);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('backend.orders.index'));
        }

        return view('backend.orders.edit')->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('backend.orders.index'));
        }

        $order = $this->orderRepository->update($request->all(), $id);

        Flash::success('Order updated successfully.');

        return redirect(route('backend.orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('backend.orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success('Order deleted successfully.');

        return redirect(route('backend.orders.index'));
    }
}