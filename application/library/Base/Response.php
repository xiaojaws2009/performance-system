<?php

/**
 * @author Macro
 * @date 2018/8/7 19:20
 * @version 1.0.0
 */

namespace Base;

use Log\SeasLog;
use Yaf\Response\Http;

class Response
{
    /**
     * @param $code
     * @param $msg
     * @param array $data
     * @param null $t translate file name
     * @throws \Yaf\Exception
     */
    public static function json($code, $msg, $data = [], $t = null)
    {
        $response = new Http();
        $response->setBody(json_encode(['code' => $code, 'msg' => Lang::t($t, $msg), 'data' => $data], JSON_UNESCAPED_UNICODE));
        $response->setHeader('Content-Type', 'application/json; charset=UTF-8');
        $response->response();
        exit;
    }

    public static function string($str = '')
    {
        exit($str);
    }

    public static function setHeader($name, $value, $rep = null, $responseCode = null)
    {
        $response = new Http();

        $response->setHeader($name, $value, $rep, $responseCode);
    }

    public static function setCookie()
    {

    }

    public static function xml()
    {

    }

    public static function redirect($url)
    {
        $response = new Http();

        $response->setRedirect($url);

        $response->response();
        exit;
    }

    public static function file()
    {

    }
}