<?php
/**
 * Created by PhpStorm.
 * User: declanmcdonough
 * Date: 05/02/2017
 * Time: 19:00
 */

namespace App\Traits;


use Illuminate\Support\Facades\Response;

trait SendsApiResponse
{
    /**
     * @param $result
     * @param $message
     * @return Response
     */
    public function sendResponse($result, $message)
    {
        return Response::json(self::makeResponse($message, $result));
    }

    /**
     * @param $error
     * @param int $code
     * @return Response
     */
    public function sendError($error, $code = 404)
    {
        return Response::json(self::makeError($error), $code);
    }

    /**
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    private static function makeResponse($message, $data)
    {
        return [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
    }

    /**
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    private static function makeError($message, array $data = [])
    {
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }
}