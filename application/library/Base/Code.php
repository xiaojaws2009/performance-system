<?php

/**
 * 返回码统一类，可跟返回信息结合使用，增加多语言支持
 * 返回码为卓游平台技术规范之一，不可单独制定，所有一类、二类返回码必须通过评审组通过
 *
 *
 * @author Macro
 * @date 2018/8/7 12:58
 * @version 1.0.0
 */

namespace Base;

use Yaf\Config\Ini;

class Code
{
    public static function get($code)
    {
        // 可以在这里做多语言转换
        //return empty(self::gets()[$code]) ? null : Lang::t('Code', self::gets()[$code]);
        return empty(self::gets()[$code]) ? null : self::gets()[$code];
    }

    public static function gets()
    {
        return (new Ini(APP_PATH . "/conf/code.ini", YAF_ENV))->toArray();
    }
}