<?php

/**
 * Yaf Hook
 * @link http://www.laruence.com/manual/yaf.plugin.times.html
 *
 *
 * joy-yaf base hook,do something like rewriting route
 * @author Macro
 * @date 2018/7/30 14:58
 * @version 1.0.0
 */

use Base\Utils;
use Yaf\Registry;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class BasePlugin extends \Yaf\Plugin_Abstract
{
    public function routerStartup(Request_Abstract $request, Response_Abstract $response)
    {

    }

    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        // 已注册过的模块，先去controllers下面找对应的控制器，没有再去modules里面找
        // modules里面，如果省略controller则找IndexController,省略action则找indexAction
        if ($request->module == 'Index' && stripos(Registry::get('config')->application->modules, $request->controller) !== false) {
            $request->module = $request->controller;
            $request->controller = ($request->action != 'index') ? $request->action : 'Index';
            $request->action = 'index';
        }

        $request->setModuleName(ucfirst($request->module));
        $request->setControllerName(ucfirst(Utils::underscoreToHump($request->controller, '-', true)));
        $request->setActionName(Utils::underscoreToHump($request->action, '-', true));
    }

    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {

    }

    public function preDispatch(Request_Abstract $request, Response_Abstract $response)
    {

    }

    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {

    }

    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {

    }
}