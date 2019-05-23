<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel,Session,URL;
use Request,Redirect,Response;
class SentinelRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $actions = $request->route()->getAction();
        $user = Sentinel::getUser();
        if(!$user->hasAccess('superadmin')){
            if ( isset( $actions['role'] ) ) {
                if($user->hasAnyAccess($actions['role']) || in_array('backend', $actions['role']) ) {

                } else {
                  #  Session::set('back_unauthorized_url', URL::previous() );
                    if ( Request::ajax() ) {
                        return Response::json(['error' => true, 'message' => 'Access denied.']);
                    } else {
                        return Redirect::route('admin.backend.unauthorized');
                    }
                }
            } else {
                $tmp = explode('.', $actions['as']);

                if ( isset( $tmp[1] ) ) {

                    if ( ( ( end ( $tmp ) == 'view' || end ( $tmp ) == 'index' || end ( $tmp ) == 'show' ) && $user->hasAccess( substr($actions['as'], 0, strlen( $actions['as'] ) - strlen( end($tmp) ) - 1 ) . '.view' ) ) ||
                        ( ( end ( $tmp ) == 'delete' || end ( $tmp ) == 'destroy' ) && $user->hasAccess( substr($actions['as'], 0, strlen( $actions['as'] ) - strlen( end($tmp) ) - 1 ) . '.destroy' ) ) ||
                        ( ( end ( $tmp ) == 'create' || end ( $tmp ) == 'store' ) && $user->hasAccess( substr($actions['as'], 0, strlen( $actions['as'] ) - strlen( end($tmp) ) - 1 ) . '.create' ) ) ||
                        ( ( end ( $tmp ) == 'edit' || end ( $tmp ) == 'update' ) && $user->hasAccess( substr($actions['as'], 0, strlen( $actions['as'] ) - strlen( end($tmp) ) - 1 ) . '.update' ) ) ) {
                        //pass

                    } else {
                       # Session::set('back_unauthorized_url', URL::previous() );
                        if ( Request::ajax() ) {
                            return Response::json(['error' => true, 'message' => 'Access denied.']);
                        } else {
                            return Redirect::route('admin.backend.unauthorized');
                        }
                    }

                }
            }
        }
        return $next($request);
    }
}
