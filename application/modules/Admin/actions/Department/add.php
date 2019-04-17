<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Base\Response;
use Admin\DepartmentModel;

class addAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        if ($this->getRequest()->getMethod() == 'POST') {
            $data = [
                'name' => $this->params['name']
            ];
            if (DepartmentModel::getOne($data)) {
                Response::json(1, "记录已存在!");
            }

            $data['create_time'] = date("Y-m-d H:i:s");
            if (DepartmentModel::insert($data)) {
                Response::json(0, "success");
            }
            Response::json(1, "fail");
        }
    }

}