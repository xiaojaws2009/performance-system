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

        $year = $this->params['year'] ?? date('Y');
        $quarter = $this->params['quarter'] ?? ceil(date('n') / 3);
        $row = PerformanceModel::getRank([
            'year' => $year,
            'quarter' => $quarter,
        ]);
        $this->getView()->assign('row', $row);

        $this->getView()->assign('year', $year);
        $this->getView()->assign('quarter', $quarter);
        $this->getView()->assign('onYear', date('Y'));
        $this->getView()->assign('quarterList', Common::$quarterList);
    }

}