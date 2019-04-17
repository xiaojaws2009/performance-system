<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Base\Response;
use Admin\DepartmentModel;

class editAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        if ($this->getRequest()->getMethod() == 'POST') {
            $where = [
                'name' => $this->params['name'],
                'id[!]' => $this->params['id'],
            ];
            if (DepartmentModel::getOne($where)) {
                Response::json(1, "记录已存在!");
            }

            $data = [
                'name' => $this->params['name'],
                'update_time' => date("Y-m-d H:i:s"),
            ];
            if (DepartmentModel::update($data, ['id' => $this->params['id']])) {
                Response::json(0, "success");
            }
            Response::json(1, "fail");
        }

        $row = DepartmentModel::getOne([
            'id' => $this->params['id'],
        ]);
        if (empty($row)) {
            $this->error("记录不存在!");
        }
        $this->getView()->assign('row', $row);
    }

}