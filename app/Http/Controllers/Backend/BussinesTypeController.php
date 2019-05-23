<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateBussinesTypeRequest;
use App\Http\Requests\Backend\UpdateBussinesTypeRequest;
use App\Repositories\Backend\BussinesTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BussinesTypeController extends AppBaseController
{
    /** @var  BussinesTypeRepository */
    private $bussinesTypeRepository;

    public function __construct(BussinesTypeRepository $bussinesTypeRepo)
    {
        $this->bussinesTypeRepository = $bussinesTypeRepo;
    }

    /**
     * Display a listing of the BussinesType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bussinesTypeRepository->pushCriteria(new RequestCriteria($request));
        $bussinesTypes = $this->bussinesTypeRepository->paginate();

        return view('backend.bussines_types.index')
            ->with('bussinesTypes', $bussinesTypes);
    }

    /**
     * Show the form for creating a new BussinesType.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.bussines_types.create');
    }

    /**
     * Store a newly created BussinesType in storage.
     *
     * @param CreateBussinesTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateBussinesTypeRequest $request)
    {
        $input = $request->all();

        $bussinesType = $this->bussinesTypeRepository->create($input);

        Flash::success('Bussines Type saved successfully.');

        return redirect(route('backend.bussinesTypes.index'));
    }

    /**
     * Display the specified BussinesType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bussinesType = $this->bussinesTypeRepository->findWithoutFail($id);

        if (empty($bussinesType)) {
            Flash::error('Bussines Type not found');

            return redirect(route('backend.bussinesTypes.index'));
        }

        return view('backend.bussines_types.show')->with('bussinesType', $bussinesType);
    }

    /**
     * Show the form for editing the specified BussinesType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bussinesType = $this->bussinesTypeRepository->findWithoutFail($id);

        if (empty($bussinesType)) {
            Flash::error('Bussines Type not found');

            return redirect(route('backend.bussinesTypes.index'));
        }

        return view('backend.bussines_types.edit')->with('bussinesType', $bussinesType);
    }

    /**
     * Update the specified BussinesType in storage.
     *
     * @param  int              $id
     * @param UpdateBussinesTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBussinesTypeRequest $request)
    {
        $bussinesType = $this->bussinesTypeRepository->findWithoutFail($id);

        if (empty($bussinesType)) {
            Flash::error('Bussines Type not found');

            return redirect(route('backend.bussinesTypes.index'));
        }

        $bussinesType = $this->bussinesTypeRepository->update($request->all(), $id);

        Flash::success('Bussines Type updated successfully.');

        return redirect(route('backend.bussinesTypes.index'));
    }

    /**
     * Remove the specified BussinesType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bussinesType = $this->bussinesTypeRepository->findWithoutFail($id);

        if (empty($bussinesType)) {
            Flash::error('Bussines Type not found');

            return redirect(route('backend.bussinesTypes.index'));
        }

        $this->bussinesTypeRepository->delete($id);

        Flash::success('Bussines Type deleted successfully.');

        return redirect(route('backend.bussinesTypes.index'));
    }
}
