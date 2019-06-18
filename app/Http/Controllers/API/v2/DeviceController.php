<?php

namespace App\Http\Controllers\API\v2;

use App\Http\Requests\API\CreateDeviceAPIRequest;
use App\Http\Requests\API\UpdateDeviceAPIRequest;
use App\Models\Device;
use App\Repositories\Api\DeviceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DeviceController
 * @package App\Http\Controllers\API
 */
class DeviceController extends AppBaseController
{
    /** @var  DeviceRepository */
    private $deviceRepository;

    public function __construct(DeviceRepository $deviceRepo)
    {
        $this->deviceRepository = $deviceRepo;
    }

    /**
     * Display a listing of the Device.
     * GET|HEAD /devices
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $profile = \Auth::user();

        $this->deviceRepository->pushCriteria(new RequestCriteria($request));
        $this->deviceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $devices = $this->deviceRepository->findByField('profile_id', $profile->id);

        return $this->sendResponse($devices->toArray(), 'Devices retrieved successfully');
    }

    /**
     * Store a newly created Device in storage.
     * POST /devices
     *
     * @param CreateDeviceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviceAPIRequest $request)
    {
        $profile = \Auth::user();

        $input = $request->all();
        $input['profile_id'] = $profile->id;

        $devices = $this->deviceRepository->findByField('profile_id', $profile->id)->toArray();
        if (!empty($devices)) {
            $device = $this->deviceRepository->update($input, $devices[0]['id']);
        } else {
            $device = $this->deviceRepository->create($input);

        }
        return $this->sendResponse($device->toArray(), 'Device saved successfully');
    }

    /**
     * Display the specified Device.
     * GET|HEAD /devices/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Device $device */
        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            return $this->sendError('Device not found');
        }

        return $this->sendResponse($device->toArray(), 'Device retrieved successfully');
    }

    /**
     * Update the specified Device in storage.
     * PUT/PATCH /devices/{id}
     *
     * @param  int $id
     * @param UpdateDeviceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Device $device */
        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            return $this->sendError('Device not found');
        }

        $device = $this->deviceRepository->update($input, $id);

        return $this->sendResponse($device->toArray(), 'Device updated successfully');
    }

    /**
     * Remove the specified Device from storage.
     * DELETE /devices/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Device $device */
        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            return $this->sendError('Device not found');
        }

        $device->delete();

        return $this->sendResponse($id, 'Device deleted successfully');
    }
}
