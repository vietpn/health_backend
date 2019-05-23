<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateBussinesTypeAPIRequest;
use App\Http\Requests\API\UpdateBussinesTypeAPIRequest;
use App\Models\BussinesType;
use App\Repositories\Api\BussinesTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BussinesTypeController
 * @package App\Http\Controllers\API
 */

class BussinesTypeController extends AppBaseController
{
    /** @var  BussinesTypeRepository */
    private $bussinesTypeRepository;

    public function __construct(BussinesTypeRepository $bussinesTypeRepo)
    {
        $this->bussinesTypeRepository = $bussinesTypeRepo;
    }

    /**
     * Display a listing of the BussinesType.
     * GET|HEAD /bussinesTypes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bussinesTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->bussinesTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $bussinesTypes = $this->bussinesTypeRepository->all();

        return $this->sendResponse($bussinesTypes->toArray(), 'Bussines Types retrieved successfully');
    }

}
