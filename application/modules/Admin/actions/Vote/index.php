<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Admin\lib\Common;
use Admin\PerformanceModel;

class indexAction extends \Base\ActionBase
{

    public function execute()
    {
        parent::execute();

        $row = PerformanceModel::getRankGroupByQuarter([
            //'employee_id' => $this->user['id'],
        ]);
        $this->getView()->assign('row', $row);

        $this->getView()->assign('quarterList', Common::$quarterList);
    }

}