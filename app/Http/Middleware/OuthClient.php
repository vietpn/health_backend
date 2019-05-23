<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use App\Http\Controllers\AppBaseController;
class OuthClient
{
    private $baseApi;
    public function __construct(AppBaseController $baseApi)
    {

        $this->baseApi = new AppBaseController();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $clientId = $request->header('client_id');
        $clientSecret = $request->header('client_secret');

        if (!isset($clientId))
            $clientId = $request->get('client-id');
        if (!isset($clientSecret))
            $clientSecret = $request->get('client-secret');

        if (empty($clientId) || empty($clientSecret)) {
            return $this->baseApi->sendError('Missing request param: client-id or client-secret',404);
        }
        $client = DB::table('oauth_clients')->where('name', $clientId)->where('secret', $clientSecret)->first();
        if ($client) {
            return $next($request);
        } else {
            return $this->baseApi->sendError('client is not valid',422);
        }
    }
}
