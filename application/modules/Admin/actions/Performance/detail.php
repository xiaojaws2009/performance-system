<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Admin\lib\Common;
use Admin\PerformanceModel;

class detailAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        $year = $this->params['year'] ?? date('Y');
        $quarter = $this->params['quarter'] ?? ceil(date('n') / 3);
        $manager_id = $this->params['id'];
        $employee_name = $this->params['employee_name'] ?? '';
        $row = PerformanceModel::getDetail([
            'year' => $year,
            'quarter' => $quarter,
            'manager_id' => $manager_id,
            'employee_name' => $employee_name,
        ]);
        $this->getView()->assign('row', $row);

        $this->getView()->assign('year', $year);
        $this->getView()->assign('quarter', $quarter);
        $this->getView()->assign('employee_name', $employee_name);
        $this->getView()->assign('quarterList', Common::$quarterList);
    }

}