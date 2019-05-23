<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateNgWordAPIRequest;
use App\Http\Requests\API\UpdateNgWordAPIRequest;
use App\Models\NgWord;
use App\Repositories\Api\NgWordRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class NgWordController
 * @package App\Http\Controllers\API
 */

class NgWordController extends AppBaseController
{
    /** @var  NgWordRepository */
    private $ngWordRepository;

    public function __construct(NgWordRepository $ngWordRepo)
    {
        $this->ngWordRepository = $ngWordRepo;
    }

    /**
     * Display a listing of the NgWord.
     * GET|HEAD /ngWords
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->ngWordRepository->pushCriteria(new RequestCriteria($request));
        $total = count($this->ngWordRepository->all());
        $this->ngWordRepository->pushCriteria(new LimitOffsetCriteria($request));
        $ngWords = $this->ngWordRepository->all();

        return $this->sendResponse($ngWords->toArray(), 'Ng Words retrieved successfully', $total);
    }

}
