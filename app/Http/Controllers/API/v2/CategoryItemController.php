<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateCategoryItemRequest;
use App\Http\Requests\API\UpdateCategoryItemRequest;
use App\Models\BaseModel;
use App\Models\CategoryItem;
use App\Models\Item;
use App\Models\NmCategoryItem;
use App\Repositories\Api\CategoryItemRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Input;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CategoryItemController
 * @package App\Http\Controllers\API
 */

class CategoryItemController extends AppBaseController
{
    /** @var  CategoryItemRepository */
    private $categoryItemRepository;

    public function __construct(CategoryItemRepository $categoryItemRepo)
    {
        $this->categoryItemRepository = $categoryItemRepo;
    }

    /**
     * Display a listing of the CategoryItem.
     * GET|HEAD /categoryItems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
//        $this->categoryItemRepository->pushCriteria(new RequestCriteria($request));
//        $total = count($this->categoryItemRepository->all());
//
//        $this->categoryItemRepository->pushCriteria(new LimitOffsetCriteria($request));
//        $categoryItems = $this->categoryItemRepository->all();
        $categoryItems = CategoryItem::where(['status' => BaseModel::STATUS_ENABLE])->orderBy('sort_order', 'DESC' );
        if (isset($request['type'])){
            $categoryItems = $categoryItems->where('type', $request['type']);
        }
        $total = count($categoryItems->get());

        if (isset($request['limit'])){
            $categoryItems = $categoryItems->limit($request['limit']);
        }

        if (isset($request['offset'])){
            $categoryItems = $categoryItems->offset($request['offset']);
        }

        return $this->sendResponse($categoryItems->get()->toArray(), 'Category Items retrieved successfully', $total);
    }

    /**
     * Store a newly created CategoryItem in storage.
     * POST /categoryItems
     *
     * @param CreateCategoryItemRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryItemRequest $request)
    {
        $input = $request->all();

        $categoryItems = $this->categoryItemRepository->create($input);

        return $this->sendResponse($categoryItems->toArray(), 'Category Item saved successfully');
    }

    /**
     * Display the specified CategoryItem.
     * GET|HEAD /categoryItems/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CategoryItem $categoryItem */
        $categoryItem = $this->categoryItemRepository->findWithoutFail($id);

        if (empty($categoryItem)) {
            return $this->sendError('Category Item not found', 500);
        }

        return $this->sendResponse($categoryItem->toArray(), 'Category Item retrieved successfully');
    }

    /**
     * Update the specified CategoryItem in storage.
     * PUT/PATCH /categoryItems/{id}
     *
     * @param  int $id
     * @param UpdateCategoryItemAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryItemRequest $request)
    {
        $input = $request->all();

        /** @var CategoryItem $categoryItem */
        $categoryItem = $this->categoryItemRepository->findWithoutFail($id);

        if (empty($categoryItem)) {
            return $this->sendError('Category Item not found', 500);
        }

        $categoryItem = $this->categoryItemRepository->update($input, $id);

        return $this->sendResponse($categoryItem->toArray(), 'CategoryItem updated successfully');
    }

    /**
     * Remove the specified CategoryItem from storage.
     * DELETE /categoryItems/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CategoryItem $categoryItem */
        $categoryItem = $this->categoryItemRepository->findWithoutFail($id);

        if (empty($categoryItem)) {
            return $this->sendError('Category Item not found', 500);
        }

        $categoryItem->delete();

        return $this->sendResponse($id, 'Category Item deleted successfully');
    }

    /**
     *
     * @param $cate_id
     * @return array
     */
    public function getItemsByCate($cate_id){
        $query = Item::where('category_id', $cate_id)->where('status', BaseModel::STATUS_ENABLE);

        $limit = Input::get('limit', null);
        $offset = Input::get('offset', null);

        $total = count($query->get());

        if ( isset($limit)){
            $query = $query->limit($limit);
        }

        if (isset($offset)){
            $query = $query->offset($offset);
        }
            
        return $this->sendResponse($query->get(), 'OK', $total);
    }

    /**
     *
     * @param $code
     * @return array
     */
    public function getItemsByCode($code){
        $category = CategoryItem::select('id')->where('code', $code)->first();
        if (!isset($category)){
            return $this->sendError('Category (code='.$code.') not found', 500);
        }
        return $this->getItemsByCate($category->id);
    }
}
