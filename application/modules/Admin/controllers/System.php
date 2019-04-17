<?php

/**
 * 系统管理
 *
 * @author Error
 * @date 2019/4/10 10:47
 * @version 1.0.0
 */

class SystemController extends \Base\Api
{
    protected function rules(){
    }

    public function init()
    {
        if ($this->getRequest()->getMethod() == 'POST') {
            $this->isValidate = true;
        }
        parent::init();

        $request = $this->getRequest();
        $action = sprintf("modules/%s/actions/%s/%s.php", $this->getModuleName(), $request->getControllerName(),
            $request->getActionName());
        $this->actions[$request->action] = $action;
    }

}
