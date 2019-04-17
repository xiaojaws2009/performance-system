<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Admin\lib\Common;
use Admin\AuthRouteModel;
use Admin\lib\Auth;

class indexAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        //获取用户权限--写入权限信息
/*        $authRoute = AuthRouteModel::getRowByGroupId($this->user['group_id']);
        $userRoute = [];
        foreach ($authRoute as $value) {
            $userRoute[$value['path']] = $value;
        }
        //\Yaf\Session::getInstance()->set('userRoute', $userRoute);
        Auth::write([$this->user['group_id']=>$userRoute]);*/

        //生成菜单
        $menu = Common::buildMenu($this->userRoute);
        $this->getView()->assign('menu', $menu);
    }

}