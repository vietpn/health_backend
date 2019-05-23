<?php

namespace App\Http\Controllers\Backend\Permission;

use App\Models\Permission\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Session, Redirect, Lang, Sentinel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = Role::paginate();
        return view('backend.permissions.role.index', compact('group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permissions.role.create', ['permissions' => $this->getAllPermissions()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        if (empty ($request->get('permissions'))) {
            $errors = new \Illuminate\Support\MessageBag;
            $errors->add(
                'editError',
                'Cần chọn ít nhất một quyền cho nhóm.'
            );
            return Redirect::back()->withErrors($errors)->withInput();
        }

        $_permissions = [];
        foreach ($request->get('permissions') as $value) {
            $_permissions[$value] = true;
        }
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => Input::get('name'),
            'slug' => str_slug(Input::get('name')),
            'permissions' => $_permissions,
        ]);
        Session::flash('message', Lang::get('systems.success'));
        Session::flash('alert-class', 'alert-info');
        return Redirect::route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = $this->findModel(intval($id));
        $group->permissions = json_decode($group->permissions, true);
        $permissions = $this->getAllPermissions();
        return view('backend.permissions.role.show', compact('group', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = $this->findModel(intval($id));
        $group->permissions = json_decode($group->permissions, true);
        $permissions = $this->getAllPermissions();
        return view('backend.permissions.role.edit', compact('group', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $group = $this->findModel(intval($id));
        if (empty ($request->get('permissions'))) {
            $errors = new \Illuminate\Support\MessageBag;
            $errors->add(
                'editError',
                'Cần chọn ít nhất một quyền cho nhóm.'
            );
            return Redirect::back()->withErrors($errors)->withInput();
        }
        $_permissions = [];
        foreach ($request->get('permissions') as $value) {
            $_permissions[$value] = true;
        }
        $group = Sentinel::findRoleById(intval($id));
        $group->name = $request->get('name', $group->name);
        $group->slug = str_slug($request->get('name', $group->name));
        $group->permissions = $_permissions;
        $group->save();
        Session::flash('message', Lang::get('systems.success'));
        Session::flash('alert-class', 'alert-info');
        return Redirect::route('admin.roles.index');
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
                $role = Sentinel::findRoleById(intval($id));
                if($role){
                    if($role->users()->count() > 0){
                        $return['error'] = true;
                        $return['message'] = trans('systems.not_delete');
                    }else{
                        $role->delete();
                        $return['error'] = false;
                        $return['message'] = trans('systems.delete_success');
                    }
                }

            }catch (\Exception $e){
                $return['message'] = $e->getMessage();
            }
        }
        return \Response::json($return);
    }

    private function getAllPermissions()
    {
        $routes = \Route::getRoutes();
        $permissions = [];
        foreach ($routes as $route) {
            $name = $route->getName();

            if ( (substr($name, 0, 5) == 'admin' || substr($name, 0, 7) == 'backend')
                 && $name != 'backend.logout' && $name != 'backend.login' && $name != 'backend.postLogin' && $name != 'admin.backend.unauthorized' && $name != 'admin.user.change_password_put') {

                $action = $route->getAction();
                if (isset($action['role'])) {
                    foreach ($action['role'] as $role) {
//                        $role = $name;

                        $oneDot = explode('.', $role);

                        if (isset($oneDot[1])) {
                            $permissions[substr($role, 0, strlen($role) - strlen(end($oneDot)) - 1)][] = end($oneDot);
                        }
                    }
                } else {
//                    if (substr($name, 0, 7) == 'backend'){
//                        $routeName = substr($name, 8, strlen($name));
//                    } else {
//                        $routeName = substr($name, 6, strlen($name));
//                    }
                    $routeName = $name;
                    $oneDot = explode('.', $routeName);
                    if (isset($oneDot[1])) {
                        $permissions[substr($routeName, 0, strlen($routeName) - strlen(end($oneDot)) - 1)][] = end($oneDot);
                    }
                }
            }
        }

        foreach ($permissions as $key => $value) {
            foreach ($value as $k => $v) {
                if ($v == 'view' || $v == 'index' || $v == 'show')
                    $value[$k] = 'view';
                if ($v == 'delete' || $v == 'destroy')
                    $value[$k] = 'destroy';
                if ($v == 'create' || $v == 'store')
                    $value[$k] = 'create';
                if ($v == 'edit' || $v == 'update')
                    $value[$k] = 'update';
            }
            $permissions[$key] = array_unique(($value));
        }

        //var_dump($permissions);
        return $permissions;
    }

    private function findModel($id)
    {
        if (($model = Role::find($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
