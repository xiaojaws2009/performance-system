<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Admin\EmployeeModel;
use Admin\DepartmentModel;
use Base\Utils;

class indexAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        $row = EmployeeModel::getList(['is_manager' => 1]);
        $this->getView()->assign('row', $row);

        $departmentList = Utils::formatData(DepartmentModel::getList(), 'id', 'name');
        $this->getView()->assign('departmentList', $departmentList);
    }

}