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
    public function sendResponse($result)
    {
        return Response::json(self::makeResponse($result));
    }

    /**
     * @param $result
     * @param $message
     * @return Response
     */
    public function sendCollectionResponse($result)
    {
        return Response::json(self::makeCollectionResponse($result));
    }

    /**
     * @param $error
     * @param int $code
     * @return Response
     */
    public function sendError($error, $code = 404)
    {
        return Response::json(self::makeError($error, $code), $code);
    }

    /**
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    private static function makeResponse($data)
    {
        return [
            'success' => true,
            'data'   => $data
        ];
    }

    /**
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    private static function makeCollectionResponse($data)
    {
        return [
            'success' => true,
            'items'   => $data
        ];
    }

    /**
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    private static function makeError($message, $code)
    {
        $response = [
            'success' => false,
            'error' => [
                "message" => $message,
                "code" => $code
            ],
        ];

        return $response;
    }
}