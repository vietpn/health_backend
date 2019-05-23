<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreatePointConfigRequest;
use App\Http\Requests\Backend\UpdatePointConfigRequest;
use App\Repositories\Backend\PointConfigRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PointConfigController extends AppBaseController
{
    /** @var  PointConfigRepository */
    private $pointConfigRepository;

    public function __construct(PointConfigRepository $pointConfigRepo)
    {
        $this->pointConfigRepository = $pointConfigRepo;
    }

    /**
     * Display a listing of the PointConfig.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pointConfigRepository->pushCriteria(new RequestCriteria($request));
        $pointConfigs = $this->pointConfigRepository->paginate();

        return view('backend.point_configs.index')
            ->with('pointConfigs', $pointConfigs);
    }

    /**
     * Show the form for creating a new PointConfig.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.point_configs.create');
    }

    /**
     * Store a newly created PointConfig in storage.
     *
     * @param CreatePointConfigRequest $request
     *
     * @return Response
     */
    public function store(CreatePointConfigRequest $request)
    {
        $input = $request->all();

        $pointConfig = $this->pointConfigRepository->create($input);

        Flash::success('Point Config saved successfully.');

        return redirect(route('backend.pointConfigs.index'));
    }

    /**
     * Display the specified PointConfig.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pointConfig = $this->pointConfigRepository->findWithoutFail($id);

        if (empty($pointConfig)) {
            Flash::error('Point Config not found');

            return redirect(route('backend.pointConfigs.index'));
        }

        return view('backend.point_configs.show')->with('pointConfig', $pointConfig);
    }

    /**
     * Show the form for editing the specified PointConfig.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pointConfig = $this->pointConfigRepository->findWithoutFail($id);

        if (empty($pointConfig)) {
            Flash::error('Point Config not found');

            return redirect(route('backend.pointConfigs.index'));
        }

        return view('backend.point_configs.edit')->with('pointConfig', $pointConfig);
    }

    /**
     * Update the specified PointConfig in storage.
     *
     * @param  int              $id
     * @param UpdatePointConfigRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePointConfigRequest $request)
    {
        $pointConfig = $this->pointConfigRepository->findWithoutFail($id);

        if (empty($pointConfig)) {
            Flash::error('Point Config not found');

            return redirect(route('backend.pointConfigs.index'));
        }

        $pointConfig = $this->pointConfigRepository->update($request->all(), $id);

        Flash::success('Point Config updated successfully.');

        return redirect(route('backend.pointConfigs.index'));
    }

    /**
     * Remove the specified PointConfig from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pointConfig = $this->pointConfigRepository->findWithoutFail($id);

        if (empty($pointConfig)) {
            Flash::error('Point Config not found');

            return redirect(route('backend.pointConfigs.index'));
        }

        $this->pointConfigRepository->delete($id);

        Flash::success('Point Config deleted successfully.');

        return redirect(route('backend.pointConfigs.index'));
    }
}
