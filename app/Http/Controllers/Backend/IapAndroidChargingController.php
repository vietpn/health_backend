<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateIapAndroidChargingRequest;
use App\Http\Requests\Backend\UpdateIapAndroidChargingRequest;
use App\Repositories\Backend\IapAndroidChargingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class IapAndroidChargingController extends AppBaseController
{
    /** @var  IapAndroidChargingRepository */
    private $iapAndroidChargingRepository;

    public function __construct(IapAndroidChargingRepository $iapAndroidChargingRepo)
    {
        $this->iapAndroidChargingRepository = $iapAndroidChargingRepo;
    }

    /**
     * Display a listing of the IapAndroidCharging.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->iapAndroidChargingRepository->pushCriteria(new RequestCriteria($request));
        $iapAndroidChargings = $this->iapAndroidChargingRepository->paginate();

        /*$iapAndroidChargings = IapAndroidCharging::paginate(15);*/

        return view('backend.iap_android_chargings.index')
            ->with('iapAndroidChargings', $iapAndroidChargings);
    }

    /**
     * Display the specified IapIosCharging.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $iapAndroidCharging = $this->iapAndroidChargingRepository->findWithoutFail($id);

        if (empty($iapAndroidCharging)) {
            Flash::error('Iap Ios Charging not found');

            return redirect(route('backend.iapIosChargings.index'));
        }

        return view('backend.iap_android_chargings.show')->with('iapAndroidCharging', $iapAndroidCharging);
    }
}
