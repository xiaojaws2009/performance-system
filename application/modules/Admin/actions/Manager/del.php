<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Base\Response;
use Admin\EmployeeModel;

class delAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        if ($this->getRequest()->getMethod() == 'POST') {
            if (EmployeeModel::delete([
                'id' => $this->params['id'],
                'is_manager' => 1,
            ])) {
                Response::json(0, "success");
            }
            Response::json(1, "fail");
        }
    }

}