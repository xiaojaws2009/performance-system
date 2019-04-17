<?php

/**
 * 投票管理
 *
 * @author Error
 * @date 2019/4/10 10:47
 * @version 1.0.0
 */

class VoteController extends \Base\Api
{
    protected function rules(){
        return [
            'add' => [
                [['manager_id', 'ability_score', 'attitude_score', 'leadership_score'], 'required'],
                [['manager_id'], 'integer', 'length' => [1, 2147483647]],
                [['ability_score', 'attitude_score', 'leadership_score'], 'integer', 'length' => [1, 100]],
            ],
        ];
    }

    public function init()
    {
        if ($this->getRequest()->getMethod() == 'POST') {
            $this->isValidate = true;
        }
        parent::init();

        $request = $this->getRequest();
        $action = sprintf("modules/%s/actions/%s/%s.php", $this->getModuleName(), $request->getControllerName(),
            $request->getActionName());
        $this->actions[$request->action] = $action;
    }

}
