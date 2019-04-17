<?php

/**
 * 引导程序 Bootstrap
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 *
 * @author Macro
 * @date 2018/7/18 12:09
 * @version 1.0.0
 * @see http://us1.php.net/manual/zh/class.yaf-bootstrap-abstract.php
 *
 *
 * @todo 其它框架必须初始化的方法
 */

use Yaf\Dispatcher;
use Yaf\Bootstrap_Abstract;

class Bootstrap extends Bootstrap_Abstract
{
    /** init global config */
    public function _initConfig()
    {
        // set application config
        $config = \Yaf\Application::app()->getConfig();
        Yaf\Registry::set("config", $config);
    }

    /** register plugins */
    public function _initPlugin(Dispatcher $dispatcher)
    {
        //注册一个插件
        $dispatcher->registerPlugin(new BasePlugin());
    }

    /** rewrite routing */
    public function _initRoute(Yaf\Dispatcher $dispatcher)
    {

    }

    public function _initTest(Yaf\Dispatcher $dispatcher)
    {
        //var_dump($dispatcher);exit;
    }

    public function _initSeasLog(Yaf\Dispatcher $dispatcher)
    {
        //SeasLog::setLogger('joy-yaf');
    }

    /** user-defined error */
    public function _initError(Yaf\Dispatcher $dispatcher)
    {
        !DEBUG ? set_error_handler(array('Base\Error', 'setErrorHandler')) : null;
    }

    /** user-defined exception */
    public function _initException(Yaf\Dispatcher $dispatcher)
    {
        !DEBUG ? set_exception_handler(array('Base\Error', 'setExceptionHandler')) : null;
    }

    /** generate modules class dir */
    public function _initLib(Yaf\Dispatcher $dispatcher)
    {
        $namespace = [];
        foreach ($dispatcher->getApplication()->getModules() as $val) {
            $namespace[] = $val;
            $namespace[] = $val . '\lib';
        }
        Yaf\Loader::getInstance(APP_PATH . "/application/modules")->registerLocalNamespace($namespace);
    }
}