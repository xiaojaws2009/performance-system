<?php

/**
 * @author Error
 * @date 2019/4/10 19:19
 * @version 1.0.0
 */

use Base\Response;
use Admin\PerformanceModel;
use Admin\EmployeeModel;
use Admin\lib\Common;

class addAction extends \Base\ActionBase
{
    public function execute()
    {
        parent::execute();

        if ($this->getRequest()->getMethod() == 'POST') {
            if ($this->params['manager_id'] == $this->user['id']) {
                Response::json(1, "不能给自己投票!");
            }

            $where = [
                'year' => date("Y"),
                'quarter' => ceil(date('n') / 3),
                'manager_id' => $this->params['manager_id'],
                'employee_id' => $this->user['id'],
            ];
            if (PerformanceModel::getOne($where)) {
                Response::json(1, "已经投过票了!");
            }

            $total_score = $this->params['ability_score'] + $this->params['attitude_score'] + $this->params['leadership_score'];
            $data = array_merge($where, [
                'ability_score' => $this->params['ability_score'],
                'attitude_score' => $this->params['attitude_score'],
                'leadership_score' => $this->params['leadership_score'],
                'total_score' => $total_score,
                'create_time' => date("Y-m-d H:i:s"),
            ]);
            if (PerformanceModel::insert($data)) {
                Response::json(0, "success");
            }
            Response::json(1, "fail");
        }

        $managerList = EmployeeModel::getList(['is_manager' => 1]);
        $this->getView()->assign('managerList', $managerList);

        $onQuarter = ceil(date('n') / 3);
        $this->getView()->assign('onYear', date('Y'));
        $this->getView()->assign('onQuarter', Common::$quarterList[$onQuarter]);
    }

}