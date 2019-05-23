<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateIapIosChargingRequest;
use App\Http\Requests\Backend\UpdateIapIosChargingRequest;
use App\Repositories\Backend\IapIosChargingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class IapIosChargingController extends AppBaseController
{
    /** @var  IapIosChargingRepository */
    private $iapIosChargingRepository;

    public function __construct(IapIosChargingRepository $iapIosChargingRepo)
    {
        $this->iapIosChargingRepository = $iapIosChargingRepo;
    }

    /**
     * Display a listing of the IapIosCharging.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->iapIosChargingRepository->pushCriteria(new RequestCriteria($request));
        $iapIosChargings = $this->iapIosChargingRepository->paginate();

        return view('backend.iap_ios_chargings.index')
            ->with('iapIosChargings', $iapIosChargings);
    }

    /**
     * Show the form for creating a new IapIosCharging.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.iap_ios_chargings.create');
    }

    /**
     * Store a newly created IapIosCharging in storage.
     *
     * @param CreateIapIosChargingRequest $request
     *
     * @return Response
     */
    public function store(CreateIapIosChargingRequest $request)
    {
        $input = $request->all();

        $iapIosCharging = $this->iapIosChargingRepository->create($input);

        Flash::success('Iap Ios Charging saved successfully.');

        return redirect(route('backend.iapIosChargings.index'));
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
        $iapIosCharging = $this->iapIosChargingRepository->findWithoutFail($id);

        if (empty($iapIosCharging)) {
            Flash::error('Iap Ios Charging not found');

            return redirect(route('backend.iapIosChargings.index'));
        }

        return view('backend.iap_ios_chargings.show')->with('iapIosCharging', $iapIosCharging);
    }

    /**
     * Show the form for editing the specified IapIosCharging.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $iapIosCharging = $this->iapIosChargingRepository->findWithoutFail($id);

        if (empty($iapIosCharging)) {
            Flash::error('Iap Ios Charging not found');

            return redirect(route('backend.iapIosChargings.index'));
        }

        return view('backend.iap_ios_chargings.edit')->with('iapIosCharging', $iapIosCharging);
    }

    /**
     * Update the specified IapIosCharging in storage.
     *
     * @param  int              $id
     * @param UpdateIapIosChargingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIapIosChargingRequest $request)
    {
        $iapIosCharging = $this->iapIosChargingRepository->findWithoutFail($id);

        if (empty($iapIosCharging)) {
            Flash::error('Iap Ios Charging not found');

            return redirect(route('backend.iapIosChargings.index'));
        }

        $iapIosCharging = $this->iapIosChargingRepository->update($request->all(), $id);

        Flash::success('Iap Ios Charging updated successfully.');

        return redirect(route('backend.iapIosChargings.index'));
    }

    /**
     * Remove the specified IapIosCharging from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $iapIosCharging = $this->iapIosChargingRepository->findWithoutFail($id);

        if (empty($iapIosCharging)) {
            Flash::error('Iap Ios Charging not found');

            return redirect(route('backend.iapIosChargings.index'));
        }

        $this->iapIosChargingRepository->delete($id);

        Flash::success('Iap Ios Charging deleted successfully.');

        return redirect(route('backend.iapIosChargings.index'));
    }
}
