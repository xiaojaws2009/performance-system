<?php

/**
 * translate class
 *
 * @author Macro
 * @date 2018/7/31 17:48
 * @version 1.0.0
 */

namespace Base;

use Yaf\Registry;
use Yaf\Config\Ini;

class Lang
{
    /**
     * to translate message
     *
     * @param string $category  fileName
     * @param string $message   to be translated information
     * @param array $params     dynamic params,support four
     * @param null $language    set language
     * @return mixed
     * @throws \Yaf\Exception
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        if (empty(Registry::get('config')['lang']['default'])) {
            throw new \Yaf\Exception("default language required");
        }

        if (Registry::get('config')['lang']['default'] == false) {
            return $message;
        }

        if ($language == null) {
            $language = empty(Registry::get('language')) ? Registry::get('config')['lang']['default'] : Registry::get('language');
        }

        if (!file_exists(APP_PATH . "/conf/lang/{$language}/{$category}.ini")) {
            return $message;
        }

        $langConfig = (new Ini(APP_PATH . "/conf/lang/{$language}/{$category}.ini", YAF_ENV));
        if ($langConfig->$message) {
            return str_replace(array('{0}', '{1}', '{2}', '{3}'), $params, $langConfig->$message);
        }

        return $message;
    }

    /**
     * set language
     *
     * @param $language
     * @throws \Yaf\Exception
     */
    public static function setLang($language)
    {
        if (!in_array($language, ['zh_cn'])) {
            throw new \Yaf\Exception("{$language} not in list");
        }

        Registry::set('language', $language);
    }
}