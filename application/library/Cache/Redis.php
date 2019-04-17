<?php

/**
 * Redis parent class in order to build key
 * the rule is compatible with Yii2
 *
 * @author Macro
 * @date 2018/7/30 10:03
 * @version 1.0.0
 */

namespace Cache;

class Redis extends \Redis
{
    public $keyPrefix;

    public function __construct($keyPrefix)
    {
        parent::__construct();
        $this->keyPrefix = $keyPrefix;
    }

    public function buildKey($key)
    {
        if (is_string($key)) {
            $key = ctype_alnum($key) && mb_strlen($key, '8bit') <= 32 ? $key : md5($key);
        } else {
            $key = md5(json_encode($key));
        }

        return $this->keyPrefix . $key;
    }
    
    public function get($key)
    {
        return unserialize(parent::get($this->buildKey($key)))[0];
    }

    public function set($key, $value, $timeout = 86400)
    {
        // compatible Yii2, serialize value
        $value = serialize([$value, null]);
        if ($timeout && is_numeric($timeout)) {
            return $this->setex($this->buildKey($key), $timeout, $value);
        } else {
            return $this->set($this->buildKey($key), $value);
        }
    }

    public function del($key)
    {
        parent::del($this->buildKey($key));
    }
}