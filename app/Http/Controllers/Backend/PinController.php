<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreatePinRequest;
use App\Http\Requests\Backend\UpdatePinRequest;
use App\Models\Pin;
use App\Repositories\Backend\PinRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PinController extends AppBaseController
{
    /** @var  PinRepository */
    private $pinRepository;

    public function __construct(PinRepository $pinRepo)
    {
        $this->pinRepository = $pinRepo;
    }

    /**
     * Display a listing of the Pin.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $status = Input::get('status', '');
        $start_time = Input::get('start_time', '');
        $end_time = Input::get('end_time', '');

        $query = Pin::select();

        if (isset($status) && $status !== ''){
            $query->where(['status' => $status]);
        }

        if (!empty($start_time)) {
            $startTime = \DateTime::createFromFormat('Y-m-d', $start_time);
            $query->where('created_at', '>=', $startTime->format('Y-m-d 00:00:00'));
        }

        if (!empty($end_time)) {
            $endTime = \DateTime::createFromFormat('Y-m-d', $end_time);
            $query->where('created_at', '<=', $endTime->format('Y-m-d 23:59:59'));
        }

        $pins = $query->paginate();

        return view('backend.pins.index')
            ->with(['pins' => $pins, 'status' => $status, 'start_time' => $start_time, 'end_time' => $end_time]);
    }

    /**
     * Show the form for creating a new Pin.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.pins.create');
    }

    /**
     * Store a newly created Pin in storage.
     *
     * @param CreatePinRequest $request
     *
     * @return Response
     */
    public function store(CreatePinRequest $request)
    {
        $model = new Pin();
        $model->name = Input::get('name', "");
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

        Flash::success('Pin saved successfully.');

        return redirect(route('backend.pins.index'));
    }

    /**
     * Display the specified Pin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pin = $this->pinRepository->findWithoutFail($id);

        if (empty($pin)) {
            Flash::error('Pin not found');

            return redirect(route('backend.pins.index'));
        }

        return view('backend.pins.show')->with('pin', $pin);
    }

    /**
     * Show the form for editing the specified Pin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pin = $this->pinRepository->findWithoutFail($id);

        if (empty($pin)) {
            Flash::error('Pin not found');

            return redirect(route('backend.pins.index'));
        }

        return view('backend.pins.edit')->with('pin', $pin);
    }

    /**
     * Update the specified Pin in storage.
     *
     * @param  int              $id
     * @param UpdatePinRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePinRequest $request)
    {
        $pin = $this->pinRepository->findWithoutFail($id);

        if (empty($pin)) {
            Flash::error('Pin not found');

            return redirect(route('backend.pins.index'));
        }

        $pin->name = Input::get('name', "");
        $pin->point = Input::get('point',0);
        $pin->status = Input::get('status');

        $file = Input::file('avatar');
        if ( isset($file) && $file->isValid()){
            $destinationPath = 'uploads/avatar/' . date("Y/m/d/H");
            $extension = $file->getClientOriginalExtension();
            $fileName = substr(md5(rand()), 0, 16) . "." . $extension;
            $file->move(storage_path(STORAGE_PATH) . '/'. $destinationPath, $fileName);
            $pin->avatar = $destinationPath.'/'.$fileName;
        }
        $pin->save();

        Flash::success('Pin updated successfully.');

        return redirect(route('backend.pins.index'));
    }

    /**
     * Remove the specified Pin from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pin = $this->pinRepository->findWithoutFail($id);

        if (empty($pin)) {
            Flash::error('Pin not found');

            return redirect(route('backend.pins.index'));
        }

        $this->pinRepository->delete($id);

        Flash::success('Pin deleted successfully.');

        return redirect(route('backend.pins.index'));
    }
}
