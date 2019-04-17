<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Admin\DepartmentModel;

class indexAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        $row = DepartmentModel::getList();
        $this->getView()->assign('row', $row);
    }

}