<?php

/**
 * 绩效管理
 *
 * @author Error
 * @date 2019/4/10 10:47
 * @version 1.0.0
 */

class PerformanceController extends \Base\Api
{
    protected function rules(){
        return [
            'detail' => [
                [['id'], 'required'],
                ['id', 'integer', 'length' => [1, 2147483647]],
            ],
        ];
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
