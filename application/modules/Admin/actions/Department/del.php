<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Base\Response;
use Admin\DepartmentModel;
use Admin\EmployeeModel;

class delAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        if ($this->getRequest()->getMethod() == 'POST') {
            $employee = EmployeeModel::getOne([
                'department_id' => $this->params['id'],
                'is_manager' => 1,
            ]);
            if ($employee) {
                Response::json(1, "该部门存在部门经理，不能删除!");
            }

            if (DepartmentModel::delete([
                'id' => $this->params['id']
            ])) {
                Response::json(0, "success");
            }
            Response::json(1, "fail");
        }
    }

}