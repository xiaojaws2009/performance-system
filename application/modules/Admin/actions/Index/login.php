<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Base\Response;
use Base\Utils;
use Admin\EmployeeModel;

class loginAction extends \Yaf\Action_Abstract
{
    public function execute()
    {
        if ($this->getRequest()->getMethod() == 'POST') {
            $params = $this->getRequest()->getPost();
            $account = $params['account'];
            $password = md5($params['password']);
            $user = EmployeeModel::getRowByAccount($account, $password);
            if (empty($user)) {
                $this->getView()->display('index/error.html', ['msg' => '登录失败!', 'isRedirect' => true]);
                exit;
            }

            // 更新用户信息
            EmployeeModel::update([
                'last_login_time' => date("Y-m-d H:i:s"),
                'last_login_ip' => Utils::getIp(),
            ], [
                'id' => $user['id'],
            ]);
            \Yaf\Session::getInstance()->set('user', $user);
            Response::redirect('/Admin/index/index');
        }

        $user = \Yaf\Session::getInstance()->get('user');
        if (!empty($user)) {
            Response::redirect('/Admin/index/index');
        }

    }

}