<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Base\Response;

class logoutAction extends \Yaf\Action_Abstract
{
    public function execute()
    {
        \Yaf\Session::getInstance()->del('user');
        \Yaf\Session::getInstance()->del('userRoute');
        Response::redirect('/Admin/index/login');
    }

}