<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Sentinel,Redirect,Session;

class HomeController extends Controller
{
    public function getLogin(){
        return view('backend.login.layout');
    }

    public function postLogin(){
        $rules =[
            'email'     => 'required|email',
            'password'  => 'required',
        ];

        $validation = \Validator::make(Input::all(), $rules, trans('app'));
        if ($validation->fails()) {
            return \Redirect::route('backend.login')
                ->withErrors($validation)->withInput();
        }else{
            $email=Input::get('email');
            $password=Input::get('password');

            try
            {
                // Login credentials
                $credentials = [
                    'email'    => $email,
                    'password' => $password,
                ];

                $respose = Sentinel::authenticate($credentials);

                if(Input::get('remmember')=='on'){
                    Sentinel::authenticateAndRemember($credentials);
                }

                if ($respose === false) {
                    $errors = new \Illuminate\Support\MessageBag;
                    $errors->add('invalid', trans('app.auth.invalid'));
                    return Redirect::route('backend.login')->withErrors($errors)->withInput();
                }
            }
            catch (\Exception $e) {
                $errors = new \Illuminate\Support\MessageBag;
                $errors->add('invalid', trans('app.exception.invalid'));
                return Redirect::route('backend.login')->withErrors($errors)->withInput();
            };
            Session::put('email',$email);
            return Redirect::route('backend.profiles.index');
        }
    }

    public function getLogout(){
        Sentinel::logout();
        return Redirect::route('backend.login');
    }

    public function getUnauthorized(){
        return view('backend.unauthorized.index');
    }
}
