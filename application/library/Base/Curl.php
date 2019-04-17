<?php

/**
 * @author Macro
 * @date 2018/8/9 18:39
 * @version 1.0.0
 */

namespace Base;

class Curl extends \Curl\Curl
{
    public function __construct($base_url = null)
    {
        parent::__construct($base_url);

        $this->setDefaultJsonDecoder(true);
    }
}