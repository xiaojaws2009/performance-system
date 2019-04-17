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

class editAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();
        if ($this->params['id'] == 1 && $this->user['id'] != 1) {
            $this->error("超级管理员不允许修改!");
        }

        if ($this->getRequest()->getMethod() == 'POST') {
            $where = [
                "name" => $this->params['name'],
                'id[!]' => $this->params['id'],
            ];
            if (EmployeeModel::getOne($where)) {
                Response::json(1, "记录已存在!");
            }

            $data = [];
            $data['name'] = $this->params['name'];
            if (!empty($this->params['password'])) {
                $data['password'] = md5($this->params['password']);
            }
            $data['department_id'] = $this->params['department_id'];
            $data['group_id'] = $this->params['group_id'];
            $data['update_time'] = date("Y-m-d H:i:s");
            if (EmployeeModel::update($data, ['id' => $this->params['id'], 'is_manager' => 1])) {
                Response::json(0, "success");
            }
            Response::json(1, "fail");
        }

        $row = EmployeeModel::getOne([
            'id' => $this->params['id'],
            'is_manager' => 1,
        ]);
        if (empty($row)) {
            $this->error("记录不存在!");
        }
        $this->getView()->assign('row', $row);

        $departmentList = DepartmentModel::getList();
        $this->getView()->assign('departmentList', $departmentList);
        $groupList = GroupModel::getList();
        $this->getView()->assign('groupList', $groupList);
    }

}