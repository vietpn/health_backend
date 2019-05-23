<?php

namespace App\Http\Controllers\Backend\Permission;

use App\Define\Systems;
use App\Http\Requests\UserRequest;
use App\Models\Permission\Role;
use App\Models\Permission\RoleUser;
use App\Models\CmsUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session, Redirect, Lang, Sentinel,Hash;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = CmsUser::orderBy('id', Systems::SORT_DESC)->paginate();
        return view('backend.permissions.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = Role::pluck('name', 'id');
        return view('backend.permissions.user.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $credentials = [
            'last_name' => $request->get('last_name', ""),
            'first_name' => $request->get('first_name', ""),
            'email' => $request->get('email', ""),
            'password' => $request->get('password', "")
        ];
        if ($request->get('status', 0) == Systems::ACTIVE) {
            $user = Sentinel::registerAndActivate($credentials);
        } else {
            $user = Sentinel::register($credentials);
        }
        $roldUser = new RoleUser();
        $roldUser->user_id = $user->id;
        $roldUser->role_id = $request->get('groups', 0);
        $roldUser->save();
        Session::flash('message', Lang::get('systems.success'));
        Session::flash('alert-class', 'alert-info');
        return Redirect::route('admin.user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->findModel(intval($id));
        $model->group = isset($model->roleUser) ? $model->roleUser->role_id : '';
        $group = Role::pluck('name', 'id');
        return view('backend.permissions.user.show', compact('model', 'group'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->findModel(intval($id));
        $model->group = isset($model->roleUser) ? $model->roleUser->role_id : '';
        $group = Role::pluck('name', 'id');
        return view('backend.permissions.user.edit', compact('group', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $model = $this->findModel(intval($id));
        $model->last_name = $request->get('last_name', "");
        $model->first_name = $request->get('first_name', "");
        $model->email = $request->get('email', "");

        if ($model->save()) {
            $group = RoleUser::where('user_id', $model->id)->first();
            $group->role_id = $request->get('groups',0);
            $group->save();
        }
        Session::flash('message', Lang::get('systems.success'));
        Session::flash('alert-class', 'alert-info');
        return Redirect::route('admin.user.index');
    }

    public function changePassword($id){
        $user = $this->findModel(intval($id));
        $user->group = isset($user->roleUser) ? $user->roleUser->role_id : '';
        $group = Role::pluck('name', 'id');
        if(is_null($user ))
            return Redirect::route('admin.users.index');

        return view('backend.permissions.user.change_password',compact('user','group'));
    }

    public function postChangePassword($id){
        $rules = [
            'new_password' => 'required|min:8|max:20',
            'repassword' => 'same:new_password',
        ];
        $validation = \Validator::make(Input::all(), $rules);
        $validation->setAttributeNames(trans('users.user'));
        if ($validation->fails()) {
            return \Redirect::route('admin.user.change_password', $id)
                ->withErrors($validation)->withInput();
        }else{
            $model = $this->findModel(intval($id));
            $newPassword =  Hash::make(Input::get('new_password',""));
            $model->password =  $newPassword;
            if ($model->save()){
                Session::flash('message', Lang::get('systems.success'));
                Session::flash('alert-class', 'alert-info');
                return Redirect::route('admin.user.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Request::ajax()) {
            $return = ['error' => true, 'message' => '', 'success' => false];
            try{
                $user = Sentinel::findById(intval($id));
                $roleUser = RoleUser::find($id);
                if($roleUser){
                    $roleUser->delete();
                }
                if($user->delete()){
                    $return['error'] = false;
                    $return['message'] = trans('systems.delete_success');
                }
            }catch (\Exception $e){
                $return['message'] = $e->getMessage();
            }
        }
        return \Response::json($return);
    }

    private function findModel($id)
    {
        if (($model = CmsUser::find($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
