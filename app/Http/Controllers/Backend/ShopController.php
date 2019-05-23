<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateShopRequest;
use App\Http\Requests\Backend\UpdateShopRequest;
use App\Models\ProfileBussines;
use App\Repositories\Backend\ShopRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

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
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->shopRepository->pushCriteria(new RequestCriteria($request));
        $shops = $this->shopRepository->paginate();

        return view('backend.shops.index')
            ->with('shops', $shops);
    }

    /**
     * Show the form for creating a new Shop.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.shops.create');
    }

    /**
     * Store a newly created Shop in storage.
     *
     * @param CreateShopRequest $request
     *
     * @return Response
     */
    public function store(CreateShopRequest $request)
    {
        $input = $request->all();

        $model = new ProfileBussines();
        $model->name = Input::get('name', "");
        $model->hyperlink = Input::get('hyperlink',0);
        $model->bussines_type_id = Input::get('bussines_type_id', 0);

        $file = Input::file('avatar');
        if ( isset($file) && $file->isValid()){
            $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move($destinationPath, $fileName);
            $model->avatar = '/' .$destinationPath.'/'.$fileName;
        }
        $model->save();

        Flash::success('Shop saved successfully.');

        return redirect(route('backend.shops.index'));
    }

    /**
     * Display the specified Shop.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $shop = $this->shopRepository->findWithoutFail($id);

        if (empty($shop)) {
            Flash::error('Shop not found');

            return redirect(route('backend.shops.index'));
        }

        return view('backend.shops.show')->with('shop', $shop);
    }

    /**
     * Show the form for editing the specified Shop.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $shop = $this->shopRepository->findWithoutFail($id);

        if (empty($shop)) {
            Flash::error('Shop not found');

            return redirect(route('backend.shops.index'));
        }

        return view('backend.shops.edit')->with('shop', $shop);
    }

    /**
     * Update the specified Shop in storage.
     *
     * @param  int              $id
     * @param UpdateShopRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShopRequest $request)
    {
        $model = $this->shopRepository->findWithoutFail($id);

        if (empty($model)) {
            Flash::error('Shop not found');

            return redirect(route('backend.shops.index'));
        }

        $model->name = Input::get('name', "");
        $model->hyperlink = Input::get('hyperlink',0);
        $model->bussines_type_id = Input::get('bussines_type_id', 0);

        $file = Input::file('avatar');
        if ( isset($file) && $file->isValid()){
            $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move($destinationPath, $fileName);
            $model->avatar = '/' .$destinationPath.'/'.$fileName;
        }
        $model->save();

        Flash::success('Shop updated successfully.');

        return redirect(route('backend.shops.index'));
    }

    /**
     * Remove the specified Shop from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $shop = $this->shopRepository->findWithoutFail($id);

        if (empty($shop)) {
            Flash::error('Shop not found');

            return redirect(route('backend.shops.index'));
        }

        $this->shopRepository->delete($id);

        Flash::success('Shop deleted successfully.');

        return redirect(route('backend.shops.index'));
    }
}
