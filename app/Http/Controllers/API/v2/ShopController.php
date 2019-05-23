<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateShopAPIRequest;
use App\Http\Requests\API\UpdateShopAPIRequest;
use App\Models\ProfileBussines;
use App\Repositories\Api\ShopRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ShopController
 * @package App\Http\Controllers\API
 */

class ShopController extends AppBaseController
{
    /** @var  ShopRepository */
    private $shopRepository;

    public function __construct(ShopRepository $shopRepo)
    {
        $this->shopRepository = $shopRepo;
    }

    /**
     * Display a listing of the Shop.
     * GET|HEAD /shops
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->shopRepository->pushCriteria(new RequestCriteria($request));
        $this->shopRepository->pushCriteria(new LimitOffsetCriteria($request));
        $shops = $this->shopRepository->all();

        return $this->sendResponse($shops->toArray(), 'Shops retrieved successfully');
    }

    /**
     * Store a newly created Shop in storage.
     * POST /shops
     *
     * @param CreateShopAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateShopAPIRequest $request)
    {
        $input = $request->all();

        $shops = $this->shopRepository->create($input);

        return $this->sendResponse($shops->toArray(), 'Shop saved successfully');
    }

    /**
     * Display the specified Shop.
     * GET|HEAD /shops/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProfileBussines $shop */
        $shop = $this->shopRepository->findWithoutFail($id);

        if (empty($shop)) {
            return $this->sendError('Shop not found');
        }

        return $this->sendResponse($shop->toArray(), 'Shop retrieved successfully');
    }

    /**
     * Update the specified Shop in storage.
     * PUT/PATCH /shops/{id}
     *
     * @param  int $id
     * @param UpdateShopAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShopAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProfileBussines $shop */
        $shop = $this->shopRepository->findWithoutFail($id);

        if (empty($shop)) {
            return $this->sendError('Shop not found');
        }

        $shop = $this->shopRepository->update($input, $id);

        return $this->sendResponse($shop->toArray(), 'Shop updated successfully');
    }

    /**
     * Remove the specified Shop from storage.
     * DELETE /shops/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProfileBussines $shop */
        $shop = $this->shopRepository->findWithoutFail($id);

        if (empty($shop)) {
            return $this->sendError('Shop not found');
        }

        $shop->delete();

        return $this->sendResponse($id, 'Shop deleted successfully');
    }
}
