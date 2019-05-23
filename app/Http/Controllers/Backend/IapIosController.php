<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateIapIosRequest;
use App\Http\Requests\Backend\UpdateIapIosRequest;
use App\Models\IapIos;
use App\Repositories\Backend\IapIosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class IapIosController extends AppBaseController
{
    /** @var  IapIosRepository */
    private $iapIosRepository;

    public function __construct(IapIosRepository $iapIosRepo)
    {
        $this->iapIosRepository = $iapIosRepo;
    }

    /**
     * Display a listing of the IapIos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->iapIosRepository->pushCriteria(new RequestCriteria($request));
        $iapIos = $this->iapIosRepository->paginate();

        /*$iapIos = IapIos::paginate(15);*/

        return view('backend.iap_ios.index')
            ->with('iapIos', $iapIos);
    }

    /**
     * Show the form for creating a new IapIos.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.iap_ios.create');
    }

    /**
     * Store a newly created IapIos in storage.
     *
     * @param CreateIapIosRequest $request
     *
     * @return Response
     */
    public function store(CreateIapIosRequest $request)
    {
        //$input = $request->all();

        $model = new IapIos();
        $model->apple_id = Input::get('apple_id');
        $model->product_id = Input::get('product_id');
        $model->display_name = Input::get('display_name');
        $model->description = Input::get('description','');
        $model->price = Input::get('price', 0);
        $model->point = Input::get('point',0);
        $model->status = Input::get('status');

        $file = Input::file('avatar');
        if ( isset($file) && $file->isValid()){
            $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move(storage_path(STORAGE_PATH) . '/'. $destinationPath, $fileName);
            $model->avatar = $destinationPath.'/'.$fileName;
        }

        $model->save();
        Flash::success('Iap Ios saved successfully.');

        return redirect(route('backend.iapIos.index'));
    }

    /**
     * Display the specified IapIos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $iapIos = $this->iapIosRepository->findWithoutFail($id);

        if (empty($iapIos)) {
            Flash::error('Iap Ios not found');

            return redirect(route('backend.iapIos.index'));
        }

        return view('backend.iap_ios.show')->with('iapIos', $iapIos);
    }

    /**
     * Show the form for editing the specified IapIos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $iapIos = $this->iapIosRepository->findWithoutFail($id);

        if (empty($iapIos)) {
            Flash::error('Iap Ios not found');

            return redirect(route('backend.iapIos.index'));
        }

        return view('backend.iap_ios.edit')->with('iapIos', $iapIos);
    }

    /**
     * Update the specified IapIos in storage.
     *
     * @param  int              $id
     * @param UpdateIapIosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIapIosRequest $request)
    {
        $model = $this->iapIosRepository->findWithoutFail($id);

        if (empty($model)) {
            Flash::error('Iap Ios not found');

            return redirect(route('backend.iapIos.index'));
        }

        $model->apple_id = Input::get('apple_id');
        $model->product_id = Input::get('product_id');
        $model->display_name = Input::get('display_name');
        $model->description = Input::get('description','');
        $model->price = Input::get('price', 0);
        $model->point = Input::get('point',0);
        $model->status = Input::get('status');

        $file = Input::file('avatar');
        if ( isset($file) && $file->isValid()){
            $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move(storage_path(STORAGE_PATH) . '/'. $destinationPath, $fileName);
            $model->avatar = $destinationPath.'/'.$fileName;
        }

        $model->save();

        Flash::success('Iap Ios updated successfully.');

        return redirect(route('backend.iapIos.index'));
    }

    /**
     * Remove the specified IapIos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $iapIos = $this->iapIosRepository->findWithoutFail($id);

        if (empty($iapIos)) {
            Flash::error('Iap Ios not found');

            return redirect(route('backend.iapIos.index'));
        }

        $this->iapIosRepository->delete($id);

        Flash::success('Iap Ios deleted successfully.');

        return redirect(route('backend.iapIos.index'));
    }
}
