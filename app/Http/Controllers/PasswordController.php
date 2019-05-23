<?php
/**
 * Created by IntelliJ IDEA.
 * User: vietpnk53
 * Date: 7/19/2017
 * Time: 4:30 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Models\PasswordReset;
use App\Repositories\Backend\PasswordResetRepository;
use App\User;

class PasswordController extends Controller
{
    /** @var  PasswordResetRepository */
    private $passwordResetRepository;

    public function __construct(PasswordResetRepository $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }

    /**
     * Show from reset password
     * @param $token
     * @return mixed
     */
    public function resetForm($token = '')
    {
        return view('password.reset')->withToken($token);
    }


    /**
     * @param PasswordResetRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reset(PasswordResetRequest $request)
    {
        // find token reset
        $passwordReset = PasswordReset::where(['token' => $request->input('token')])->first();
        $timeExpire = $_SERVER["REQUEST_TIME"] - strtotime($passwordReset->created_at);
        // check expire token
        if ($passwordReset->status == 1 ||
            $timeExpire > PASSWORD_RESET_EXPIRE
        ) {
            \Session::flash('error', 'The token reset is expired!');
            return view('password.reset')->withToken('');
        }

        // find email want to reset
        $profile = User::where(['email' => $passwordReset->email])->first();

        // set new password for user
        $profile->password = bcrypt($request->input('password'));
        $passwordReset->status = 1;
        if ($profile->save() && $passwordReset->save()) {
            \Session::flash('success', 'The password was successfully update!');
        }

        return view('password.reset')->withToken('');
    }
}