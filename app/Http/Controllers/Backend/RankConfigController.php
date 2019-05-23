<?php

namespace App\Http\Controllers\Backend;

use App\Define\Systems;
use App\Http\Requests\Backend\CreateRankConfigRequest;
use App\Http\Requests\Backend\UpdateRankConfigRequest;
use App\Repositories\Backend\RankConfigRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RankConfigController extends AppBaseController
{
    /** @var  RankConfigRepository */
    private $rankConfigRepository;

    public function __construct(RankConfigRepository $rankConfigRepo)
    {
        $this->rankConfigRepository = $rankConfigRepo;
    }

    /**
     * Display a listing of the RankConfig.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
//        $this->rankConfigRepository->pushCriteria(new RequestCriteria($request));
        $respone = $this->rankConfigRepository->getAllRank();
        if ($respone['success'] === true) {
            $model = $respone['message'];
            $rankConfigs = $model->paginate(15);
        }
        dd($rankConfigs);
        /*$rankConfigs = RankConfig::paginate(15);*/

        return view('backend.rank_configs.index')
            ->with('rankConfigs', $rankConfigs);
    }

    /**
     * Show the form for creating a new RankConfig.
     *
     * @return Response
     */
    public function create()
    {
        $model = $this->rankConfigRepository->all();

        return view('backend.rank_configs.create', compact('model'));
    }

    /**
     * Store a newly created RankConfig in storage.
     *
     * @param CreateRankConfigRequest $request
     *
     * @return Response
     */
    public function store(CreateRankConfigRequest $request)
    {
        $name = $request->input('name', []);
        $begin = $request->input('begin', []);
        $end = $request->input('end', []);
        $time = $request->input('time', Systems::THREE_MONTHS);
        if (!empty($name)) {
            foreach ($name as $key => $value) {

                $input = [];
                $input['name'] = $value;
                $input['begin'] = isset($begin[$key]) ? $begin[$key] : 0;
                if (isset($end[$key])) {
                    if ($key === 0) {
                        $input['end'] = "";
                    } else {
                        $input['end'] = (!is_null($end[$key])) ? $end[$key] : 0;
                    }
                }
                $input['time'] = $time;
                $findName = $this->rankConfigRepository->findModelName($value);
                if ($findName) {
                    $rankConfig = $this->rankConfigRepository->update($input, $findName->id);
                } else {
                    $rankConfig = $this->rankConfigRepository->create($input);
                }

            }
        }
        Flash::success('Rank Config saved successfully.');

        return redirect(route('backend.rankConfigs.index'));
    }

    /**
     * Display the specified RankConfig.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rankConfig = $this->rankConfigRepository->findWithoutFail($id);

        if (empty($rankConfig)) {
            Flash::error('Rank Config not found');

            return redirect(route('backend.rankConfigs.index'));
        }

        return view('backend.rank_configs.show')->with('rankConfig', $rankConfig);
    }

    /**
     * Show the form for editing the specified RankConfig.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rankConfig = $this->rankConfigRepository->findWithoutFail($id);

        if (empty($rankConfig)) {
            Flash::error('Rank Config not found');

            return redirect(route('backend.rankConfigs.index'));
        }

        return view('backend.rank_configs.edit')->with('rankConfig', $rankConfig);
    }

    /**
     * Update the specified RankConfig in storage.
     *
     * @param  int $id
     * @param UpdateRankConfigRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRankConfigRequest $request)
    {
        $rankConfig = $this->rankConfigRepository->findWithoutFail($id);

        if (empty($rankConfig)) {
            Flash::error('Rank Config not found');

            return redirect(route('backend.rankConfigs.index'));
        }

        $rankConfig = $this->rankConfigRepository->update($request->all(), $id);

        Flash::success('Rank Config updated successfully.');

        return redirect(route('backend.rankConfigs.index'));
    }

    /**
     * Remove the specified RankConfig from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rankConfig = $this->rankConfigRepository->findWithoutFail($id);

        if (empty($rankConfig)) {
            Flash::error('Rank Config not found');

            return redirect(route('backend.rankConfigs.index'));
        }

        $this->rankConfigRepository->delete($id);

        Flash::success('Rank Config deleted successfully.');

        return redirect(route('backend.rankConfigs.index'));
    }
}
