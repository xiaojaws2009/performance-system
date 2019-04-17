<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Base\Response;
use Admin\EmployeeModel;
use Admin\DepartmentModel;
use Admin\GroupModel;

class addAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        if ($this->getRequest()->getMethod() == 'POST') {
            if (EmployeeModel::getOne([
                "OR" => [
                    "name" => $this->params['name'],
                    "account" => $this->params['account'],
                ]
            ])
            ) {
                Response::json(1, "记录已存在!");
            }

            $data = [];
            $data['name'] = $this->params['name'];
            $data['is_manager'] = 1;
            $data['account'] = $this->params['account'];
            $data['password'] = md5($this->params['password']);
            $data['group_id'] = $this->params['group_id'];
            $data['department_id'] = $this->params['department_id'];
            $data['create_time'] = date("Y-m-d H:i:s");
            if (EmployeeModel::insert($data)) {
                Response::json(0, "success");
            }
            Response::json(1, "fail");
        }

        $departmentList = DepartmentModel::getList();
        $this->getView()->assign('departmentList', $departmentList);
        $groupList = GroupModel::getList();
        $this->getView()->assign('groupList', $groupList);
    }

}