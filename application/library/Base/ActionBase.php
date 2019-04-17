<?php

/**
 * Base controller
 * all api controller must extends Api class
 *
 * @author Macro
 * @date 2018/7/23 17:11
 * @version 1.0.0
 */

namespace Base;

use Yaf\Dispatcher;
use Admin\lib\Auth;

abstract class ActionBase extends \Yaf\Action_Abstract
{
    public $params; //请求参数
    public $user; //用户信息
    public $userRoute; //用户授权路由信息

    /**
     * global action handle
     */
	public function execute()
    {
        // 默认接收GET和POST请求
        $request = $this->getRequest();
        if ($request->isGet()) {
            $this->params = array_merge($request->getParams(), $request->getQuery());
        } elseif ($request->isPost()) {
            $this->params = $request->getPost();
        }

        // 判断用户登录
        $this->user = \Yaf\Session::getInstance()->get('user');
        $this->checkUserLogin();
        $this->getView()->assign('user', $this->user);

        // 如果是Ajax请求则关闭HTML输出，不判断权限
        if ($request->isXmlHttpRequest()) {
            Dispatcher::getInstance()->disableView();
        } else {
            $moduleName = $request->getModuleName();
            $controllerName = $request->getControllerName();
            //$this->userRoute = \Yaf\Session::getInstance()->get('userRoute');
            $this->userRoute = Auth::read($this->user['group_id']);
            if (strtolower($controllerName) != 'index') {
                $this->checkUserAuth();
            }

            $controllerRoute = $this->userRoute['/' . $moduleName . '/' . $controllerName]['name'] ?? '';
            $actionRoute = $this->userRoute['/' . $moduleName . '/' . $controllerName . '/' . $request->getActionName()]['name'] ?? '';
            $this->getView()->assign('controllerName', $controllerRoute);
            $this->getView()->assign('actionName', $actionRoute);
        }
    }

    /**
     * 获取头信息
     * @param $param
     * @return array
     */
    protected function getHeader($param)
    {
        return $this->getRequest()->getServer('HTTP_' . strtoupper($param));
    }

    /**
     * 判断用户登录
     */
    public function checkUserLogin()
    {
        if (empty($this->user)) {
            //$this->error("请重新登录!", true);
            Response::redirect('/Admin/index/login');
        }
    }

    /**
     * 判断用户权限
     */
    public function checkUserAuth()
    {
        $request = $this->getRequest();
        $requestUri = '/' . $request->getModuleName() . '/' . $request->getControllerName() . '/' . $request->getActionName();
        if (!isset($this->userRoute[$requestUri])) {
            $this->error("权限不足!");
        }
    }

    /**
     * 错误页面
     * @param $msg
     * @param $isRedirect
     */
    public function error($msg, $isRedirect = false)
    {
        $this->getView()->display('index/error.html', ['msg' => $msg, 'isRedirect' => $isRedirect]);
        exit;
    }
}
