<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateProfileReportRequest;
use App\Http\Requests\Backend\UpdateProfileReportRequest;
use App\Repositories\Backend\ProfileReportRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProfileReportController extends AppBaseController
{
    /** @var  ProfileReportRepository */
    private $profileReportRepository;

    public function __construct(ProfileReportRepository $profileReportRepo)
    {
        $this->profileReportRepository = $profileReportRepo;
    }

    /**
     * Display a listing of the ProfileReport.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->profileReportRepository->pushCriteria(new RequestCriteria($request));
        $profileReports = $this->profileReportRepository->all();

        foreach ($profileReports as $key => $profileReport){
            $profile = User::whereIn('id', [$profileReport->profile_id, $profileReport->profile_id_report])->get();
            $profileReports[$key]['profile_name'] = (isset($profile[0]->username)) ? $profile[0]->username : '';
            $profileReports[$key]['profile_report_name'] = (isset($profile[1]->username)) ? $profile[1]->username : '';
        }

        /*$profileReports = ProfileReport::paginate(15);*/

        return view('backend.profile_reports.index')
            ->with('profileReports', $profileReports);
    }


    /**
     * Display the specified ProfileReport.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profileReport = $this->profileReportRepository->findWithoutFail($id);

        if (empty($profileReport)) {
            Flash::error('Profile Report not found');

            return redirect(route('backend.profileReports.index'));
        }

        return view('backend.profile_reports.show')->with('profileReport', $profileReport);
    }

    /**
     * Show the form for editing the specified ProfileReport.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $profileReport = $this->profileReportRepository->findWithoutFail($id);

        if (empty($profileReport)) {
            Flash::error('Profile Report not found');

            return redirect(route('backend.profileReports.index'));
        }

        return view('backend.profile_reports.edit')->with('profileReport', $profileReport);
    }

    /**
     * Update the specified ProfileReport in storage.
     *
     * @param  int              $id
     * @param UpdateProfileReportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileReportRequest $request)
    {
        $profileReport = $this->profileReportRepository->findWithoutFail($id);

        if (empty($profileReport)) {
            Flash::error('Profile Report not found');

            return redirect(route('backend.profileReports.index'));
        }

        $profileReport = $this->profileReportRepository->update($request->all(), $id);

        Flash::success('Profile Report updated successfully.');

        return redirect(route('backend.profileReports.index'));
    }

    /**
     * Remove the specified ProfileReport from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profileReport = $this->profileReportRepository->findWithoutFail($id);

        if (empty($profileReport)) {
            Flash::error('Profile Report not found');

            return redirect(route('backend.profileReports.index'));
        }

        $this->profileReportRepository->delete($id);

        Flash::success('Profile Report deleted successfully.');

        return redirect(route('backend.profileReports.index'));
    }
}
