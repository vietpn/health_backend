<?php

namespace App\Http\Controllers\API\v1;

use App\Repositories\Api\PromotionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PromotionController
 * @package App\Http\Controllers\API
 */
class PromotionController extends AppBaseController
{
    /** @var  PromotionRepository */
    private $promotionRepository;

    public function __construct(PromotionRepository $promotionRepo)
    {
        $this->promotionRepository = $promotionRepo;
    }

    /**
     * Display a listing of the Promotion.
     * GET|HEAD /promotions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $promotions = $this->promotionRepository->all();

        return $this->sendResponse($promotions->toArray(), 'Promotions retrieved successfully');
    }

    public function code($code)
    {
        $promotion = $this->promotionRepository->findWhere(['code' => $code])->first();

        if (empty($promotion)) {
            return $this->sendError('Promotion not found', CODE_NOT_FOUND);
        }


        return $this->sendResponse($promotion->toArray(), 'Promotions retrieved successfully');
    }
}
