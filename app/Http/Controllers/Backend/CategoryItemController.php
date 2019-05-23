<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateCategoryItemRequest;
use App\Http\Requests\Backend\UpdateCategoryItemRequest;
use App\Models\CategoryItem;
use App\Repositories\Backend\CategoryItemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

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
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categoryItemRepository->pushCriteria(new RequestCriteria($request));
        $categoryItems = $this->categoryItemRepository->orderBy('sort_order', 'DESC')->paginate();

        return view('backend.category_items.index')
            ->with('categoryItems', $categoryItems);
    }

    /**
     * Show the form for creating a new CategoryItem.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.category_items.create');
    }

    /**
     * Store a newly created CategoryItem in storage.
     *
     * @param CreateCategoryItemRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryItemRequest $request)
    {
        $rules = array('code' => 'unique:e_category_item');
        $validator = \Validator::make(Input::get(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->withErrors(['指定のcodeは既に使用されています。']);
        }
        //$input = $request->all();
        $model = new CategoryItem();
        $model->title = Input::get('title', "");
        $model->status = Input::get('status');
        $model->sort_order = Input::get('sort_order');
        $model->type = Input::get('type');
        $model->code = Input::get('code');

        //$categoryItem = $this->categoryItemRepository->create($input);
        $file = Input::file('avatar');

        if ( isset($file) && $file->isValid()){
            $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move(storage_path(STORAGE_PATH) . '/'. $destinationPath, $fileName);
            $model->avatar = $destinationPath.'/'.$fileName;
        }

        $model->save();

        Flash::success('Category Item saved successfully.');

        return redirect(route('backend.categoryItems.index'));
    }

    /**
     * Display the specified CategoryItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoryItem = $this->categoryItemRepository->findWithoutFail($id);

        if (empty($categoryItem)) {
            Flash::error('Category Item not found');

            return redirect(route('backend.categoryItems.index'));
        }

        return view('backend.category_items.show')->with('categoryItem', $categoryItem);
    }

    /**
     * Show the form for editing the specified CategoryItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoryItem = $this->categoryItemRepository->findWithoutFail($id);

        if (empty($categoryItem)) {
            Flash::error('Category Item not found');

            return redirect(route('backend.categoryItems.index'));
        }

        return view('backend.category_items.edit')->with('categoryItem', $categoryItem);
    }

    /**
     * Update the specified CategoryItem in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryItemRequest $request)
    {
        $rules = array('code' => 'unique:e_category_item,code,'.$id.',id');
        $validator = \Validator::make(Input::get(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->withErrors(['指定のcodeは既に使用されています。']);
        }

        $model = $this->categoryItemRepository->findWithoutFail($id);
        if (empty($model)) {
            Flash::error('Category Item not found');

            return redirect(route('backend.categoryItems.index'));
        }

        $model->title = Input::get('title', "");
        $model->sort_order = Input::get('sort_order');
        $model->status = Input::get('status');
        $model->type = Input::get('type');
        $model->code = Input::get('code');

        $file = Input::file('avatar');

        if ( isset($file) && $file->isValid()){
            $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move(storage_path(STORAGE_PATH) . '/'. $destinationPath, $fileName);
            $model->avatar = $destinationPath.'/'.$fileName;
        }

        $model->save();

        //$categoryItem = $this->categoryItemRepository->update($request->all(), $id);

        Flash::success('Category Item updated successfully.');

        return redirect(route('backend.categoryItems.index'));
    }

    /**
     * Remove the specified CategoryItem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categoryItem = $this->categoryItemRepository->findWithoutFail($id);

        if (empty($categoryItem)) {
            Flash::error('Category Item not found');

            return redirect(route('backend.categoryItems.index'));
        }

        $this->categoryItemRepository->delete($id);

        Flash::success('Category Item deleted successfully.');

        return redirect(route('backend.categoryItems.index'));
    }
}
