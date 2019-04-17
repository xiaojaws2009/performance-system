<?php

/**
 * Base controller
 * all api controller must extends Api class
 *
 * @author Macro
 * @date 2018/7/23 17:11
 * @version 1.0.0
 */

namespace Base;

use Yaf\Dispatcher;

abstract class Cli extends \Yaf\Controller_Abstract
{
    /**
     * global api controller handle
     */
	public function init()
    {
        if (!$this->getRequest()->isCli()) {
            Response::string('请求方式非法,请联系技术人员');
        }
        // \SeasLog::info(json_encode([$this->getRequest()->getPost(), $this->getRequest()->getParams()]));

        $rules = empty($this->rules()[$this->getRequest()->getActionName()]) ? [] : $this->rules()[$this->getRequest()->getActionName()];
        $rules = empty($this->rules()['*']) ? $rules : array_merge($this->rules()['*'], $rules);
        Validate::analyze($rules, $this->getRequest()->getParams());

        Dispatcher::getInstance()->disableView();
    }

    abstract protected function rules();

    protected function getHeader($param)
    {
        return $this->getRequest()->getServer('HTTP_' . strtoupper($param));
    }
}
