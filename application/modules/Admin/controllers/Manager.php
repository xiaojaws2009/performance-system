<?php

/**
 * 部门经理管理
 *
 * @author Error
 * @date 2019/4/10 10:47
 * @version 1.0.0
 */

class ManagerController extends \Base\Api
{
    protected function rules(){
        return [
            'add' => [
                [['name', 'account', 'password', 'department_id', 'group_id'], 'required'],
                [['name', 'account', 'password'], 'notEmpty'],
                [['department_id', 'group_id'], 'integer', 'length' => [1, 2147483647]],
            ],
            'edit' => [
                [['name', 'id', 'department_id', 'group_id'], 'required'],
                [['name'], 'notEmpty'],
                [['id', 'department_id', 'group_id'], 'integer', 'length' => [1, 2147483647]],
            ],
            'del' => [
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
