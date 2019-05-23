<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message, $total = null)
    {
        return Response::json(self::makeResponse($message, $result, $total));
    }
    public function sendResponseUser($result){
        return Response::json($result);
    }
    public function sendError($error,$status, $code = 404)
    {
        return Response::json(self::makeError($status,$error), $code);
    }

    /**
     * @param string $message
     * @param mixed $data
     *
     * @return array
     */
    public function makeResponse($message, $data, $total)
    {
        $res = [
            'status' => 200,
            'success' => true,
            'code'  =>  1,
            'message' => $message,
            'data' => $data,
        ];

        /**
         * Return count total record for paging
        */
        if (!empty($total)){
            $res['_meta'] = [
                'count' => (int)$total,
            ];
        }
        return $res;
    }

    /**
     * @param string $message
     * @param array $data
     *
     * @return array
     */
    public static function makeError($status,$message, array $data = [])
    {
        $res = [
            'status' => $status,
            'success' => false,
            'message' => $message,
        ];

        if (!empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }

    /**
     * @return array
     */
    public function getAge()
    {
        $nam = array_combine(range(18, 70), range(18, 70));
        return $nam;
    }
}
