<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateChargePointRequest;
use App\Http\Requests\Backend\UpdateChargePointRequest;
use App\Repositories\Backend\ChargePointRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ChargePointController extends AppBaseController
{
    /** @var  ChargePointRepository */
    private $chargePointRepository;

    public function __construct(ChargePointRepository $chargePointRepo)
    {
        $this->chargePointRepository = $chargePointRepo;
    }

    /**
     * Display a listing of the ChargePoint.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->chargePointRepository->pushCriteria(new RequestCriteria($request));
        $chargePoints = $this->chargePointRepository->all();

        /*$chargePoints = ChargePoint::paginate(15);*/

        return view('backend.charge_points.index')
            ->with('chargePoints', $chargePoints);
    }

    /**
     * Show the form for creating a new ChargePoint.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.charge_points.create');
    }

    /**
     * Store a newly created ChargePoint in storage.
     *
     * @param CreateChargePointRequest $request
     *
     * @return Response
     */
    public function store(CreateChargePointRequest $request)
    {
        $input = $request->all();

        $chargePoint = $this->chargePointRepository->create($input);

        Flash::success('Charge Point saved successfully.');

        return redirect(route('backend.chargePoints.index'));
    }

    /**
     * Display the specified ChargePoint.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $chargePoint = $this->chargePointRepository->findWithoutFail($id);

        if (empty($chargePoint)) {
            Flash::error('Charge Point not found');

            return redirect(route('backend.chargePoints.index'));
        }

        return view('backend.charge_points.show')->with('chargePoint', $chargePoint);
    }

    /**
     * Show the form for editing the specified ChargePoint.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $chargePoint = $this->chargePointRepository->findWithoutFail($id);

        if (empty($chargePoint)) {
            Flash::error('Charge Point not found');

            return redirect(route('backend.chargePoints.index'));
        }

        return view('backend.charge_points.edit')->with('chargePoint', $chargePoint);
    }

    /**
     * Update the specified ChargePoint in storage.
     *
     * @param  int              $id
     * @param UpdateChargePointRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChargePointRequest $request)
    {
        $chargePoint = $this->chargePointRepository->findWithoutFail($id);

        if (empty($chargePoint)) {
            Flash::error('Charge Point not found');

            return redirect(route('backend.chargePoints.index'));
        }

        $chargePoint = $this->chargePointRepository->update($request->all(), $id);

        Flash::success('Charge Point updated successfully.');

        return redirect(route('backend.chargePoints.index'));
    }

    /**
     * Remove the specified ChargePoint from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $chargePoint = $this->chargePointRepository->findWithoutFail($id);

        if (empty($chargePoint)) {
            Flash::error('Charge Point not found');

            return redirect(route('backend.chargePoints.index'));
        }

        $this->chargePointRepository->delete($id);

        Flash::success('Charge Point deleted successfully.');

        return redirect(route('backend.chargePoints.index'));
    }
}
