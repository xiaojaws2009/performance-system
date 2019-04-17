<?php

/**
 * Default controller
 *
 * @author Macro
 * @date 2018/7/16 18:09
 * @version 1.0.0
 */

//namespace JoyYaf\Controller;

class IndexController extends \Yaf\Controller_Abstract
{
    /**
     * yaf default action vendor with `views/index/index.phtml`
     */
    public function indexAction()
    {
        $this->getView()->assign("content", "welcome to joy-yaf");
    }
}