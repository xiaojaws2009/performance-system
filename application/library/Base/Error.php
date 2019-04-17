<?php

/**
 * Error | Exception handle
 *
 * @author Macro
 * @date 2018/8/8 10:20
 * @version 1.0.0
 */

namespace Base;

class Error
{
    /**
     * @link http://us3.php.net/manual/zh/function.set-error-handler.php
     *
     *
     * 以下级别的错误不能由用户定义的函数来处理：
     *  E_ERROR、 E_PARSE、 E_CORE_ERROR、 E_CORE_WARNING、 E_COMPILE_ERROR、
     *  E_COMPILE_WARNING，和在调用 set_error_handler()函数所在文件中产生的大多数 E_STRICT。
     *
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     */
    public static function setErrorHandler($errno, $errstr, $errfile, $errline)
    {
        $type = [
            E_RECOVERABLE_ERROR => 'Catchable fatal error',
            E_WARNING => 'Run-time warnings (non-fatal errors)',
            E_NOTICE => 'Run-time notices',
            E_STRICT => 'suggest changes forward compatibility of your code',
            E_DEPRECATED => 'E_DEPRECATED',
            E_USER_ERROR => 'User-generated error message',
            E_USER_WARNING => 'User-generated warning message',
            E_USER_NOTICE => 'User-generated notice message',
            E_USER_DEPRECATED => 'User-generated warning message',
        ];

        if (in_array($errno, [E_RECOVERABLE_ERROR, E_WARNING, E_USER_ERROR])) {
            #TODO setLog
            echo $errno, $errstr, $errfile, $errline;exit;
            //Response::redirect('/Admin/index/error');

            Response::setHeader('Content-Type', 'application/json; charset=UTF-8');
            Response::string(json_encode([
                'code' => 50002,
                'msg' => Lang::t('Error', 'system error'),
                'data' => []
            ], JSON_UNESCAPED_UNICODE));
        } else {
            /** do not affect runtime, but developers must pay attention to the notice log  */
            #TODO setLog
            echo $errno, $errstr, $errfile, $errline;exit;
            //Response::redirect('/Admin/index/error');
        }
    }

    /**
     * @link  http://us3.php.net/manual/zh/function.set-exception-handler.php
     *
     * Fatal error || Unhandled exception(most of them are system throws or developers throw)
     *
     * @param \Throwable $exception
     */
    public static function setExceptionHandler($exception)
    {
        #TODO setLog
        var_dump($exception);exit;
        //Response::redirect('/Admin/index/error');

        Response::setHeader('Content-Type', 'application/json; charset=UTF-8');
        Response::string(json_encode([
            'code' => 50003,
            'msg' => Lang::t('Error', 'system uncaught exception'),
            'data' => []
        ], JSON_UNESCAPED_UNICODE));
    }
}