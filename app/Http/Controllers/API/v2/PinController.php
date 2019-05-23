<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreatePinAPIRequest;
use App\Http\Requests\API\UpdatePinAPIRequest;
use App\Models\Pin;
use App\Repositories\Api\PinRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PinController
 * @package App\Http\Controllers\API
 */

class PinController extends AppBaseController
{
    /** @var  PinRepository */
    private $pinRepository;

    public function __construct(PinRepository $pinRepo)
    {
        $this->pinRepository = $pinRepo;
    }

    /**
     * Display a listing of the Pin.
     * GET|HEAD /pins
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pinRepository->pushCriteria(new RequestCriteria($request));
        $total = count($this->pinRepository->all());
        $this->pinRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pins = $this->pinRepository->all();

        return $this->sendResponse($pins->toArray(), 'Pins retrieved successfully', $total);
    }

    /**
     * Display the specified Pin.
     * GET|HEAD /pins/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Pin $pin */
        $pin = $this->pinRepository->findWithoutFail($id);

        if (empty($pin)) {
            return $this->sendError('Pin not found', 500);
        }

        return $this->sendResponse($pin->toArray(), 'Pin retrieved successfully');
    }

}
