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

abstract class Api extends \Yaf\Controller_Abstract
{
    public $isValidate = false;

    /**
     * global api controller handle
     */
	public function init()
    {
        if ($this->isValidate) {
            $rules = empty($this->rules()[$this->getRequest()->getActionName()]) ? [] : $this->rules()[$this->getRequest()->getActionName()];
            $rules = empty($this->rules()['*']) ? $rules : array_merge($this->rules()['*'], $rules);
            Validate::analyze($rules, $this->getRequest()->getPost());
        }

        /**
         * 如果是Ajax请求, 则关闭HTML输出
         */
        if ($this->getRequest()->isXmlHttpRequest()) {
            Dispatcher::getInstance()->disableView();
        }
    }

    abstract protected function rules();

    protected function getHeader($param)
    {
        return $this->getRequest()->getServer('HTTP_' . strtoupper($param));
    }
}
