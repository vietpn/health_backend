<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateIapAndroidRequest;
use App\Http\Requests\Backend\UpdateIapAndroidRequest;
use App\Models\IapAndroid;
use App\Repositories\Backend\IapAndroidRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class IapAndroidController extends AppBaseController
{
    /** @var  IapAndroidRepository */
    private $iapAndroidRepository;

    public function __construct(IapAndroidRepository $iapAndroidRepo)
    {
        $this->iapAndroidRepository = $iapAndroidRepo;
    }

    /**
     * Display a listing of the IapAndroid.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->iapAndroidRepository->pushCriteria(new RequestCriteria($request));
        $iapAndroids = $this->iapAndroidRepository->paginate();

        /*$iapAndroids = IapAndroid::paginate(15);*/

        return view('backend.iap_androids.index')
            ->with('iapAndroids', $iapAndroids);
    }

    /**
     * Show the form for creating a new IapAndroid.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.iap_androids.create');
    }

    /**
     * Store a newly created IapAndroid in storage.
     *
     * @param CreateIapAndroidRequest $request
     *
     * @return Response
     */
    public function store(CreateIapAndroidRequest $request)
    {
        //$input = $request->all();
        $model = new IapAndroid();
        $model->product_id = Input::get('product_id');
        $model->display_name = Input::get('display_name');
        $model->package = Input::get('package');
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

        Flash::success('Iap Android saved successfully.');

        return redirect(route('backend.iapAndroids.index'));
    }

    /**
     * Display the specified IapAndroid.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $iapAndroid = $this->iapAndroidRepository->findWithoutFail($id);

        if (empty($iapAndroid)) {
            Flash::error('Iap Android not found');

            return redirect(route('backend.iapAndroids.index'));
        }

        return view('backend.iap_androids.show')->with('iapAndroid', $iapAndroid);
    }

    /**
     * Show the form for editing the specified IapAndroid.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $iapAndroid = $this->iapAndroidRepository->findWithoutFail($id);

        if (empty($iapAndroid)) {
            Flash::error('Iap Android not found');

            return redirect(route('backend.iapAndroids.index'));
        }

        return view('backend.iap_androids.edit')->with('iapAndroid', $iapAndroid);
    }

    /**
     * Update the specified IapAndroid in storage.
     *
     * @param  int              $id
     * @param UpdateIapAndroidRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIapAndroidRequest $request)
    {
        $model = $this->iapAndroidRepository->findWithoutFail($id);

        if (empty($model)) {
            Flash::error('Iap Android not found');

            return redirect(route('backend.iapAndroids.index'));
        }

        $model->product_id = Input::get('product_id');
        $model->display_name = Input::get('display_name');
        $model->package = Input::get('package');
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

        Flash::success('Iap Android updated successfully.');

        return redirect(route('backend.iapAndroids.index'));
    }

    /**
     * Remove the specified IapAndroid from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $iapAndroid = $this->iapAndroidRepository->findWithoutFail($id);

        if (empty($iapAndroid)) {
            Flash::error('Iap Android not found');

            return redirect(route('backend.iapAndroids.index'));
        }

        $this->iapAndroidRepository->delete($id);

        Flash::success('Iap Android deleted successfully.');

        return redirect(route('backend.iapAndroids.index'));
    }
}
