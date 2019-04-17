<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

class errorAction extends \Yaf\Action_Abstract
{
    public function execute()
    {
        $this->getView()->assign('isRedirect', false);
        $this->getView()->assign('msg', "系统出错啦!");
    }

}