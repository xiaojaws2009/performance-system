<?php

/**
 * Created by PhpStorm.
 * User: Error
 * Date: 2019/4/15
 * Time: 15:52
 */

namespace Admin\lib;

class Auth
{
    /**
     * 获取权限文件
     * @return string
     */
    public static function getAuthFile()
    {
        return APP_PATH . '/conf/auth.json';
    }

    /**
     * 写入权限
     * @param array $authArray
     * @return array
     */
    public static function write(array $authArray)
    {
        $authData = self::read();
        foreach ($authArray as $key => $value) {
            $authData[$key] = $value;
        }

        $authJson = json_encode($authData, JSON_UNESCAPED_UNICODE);
        if (file_put_contents(self::getAuthFile(), $authJson, LOCK_EX)) {
            return [0, "success"];
        }
        return [1, "fail"];
    }

    /**
     * 读取权限
     * @param string $key
     * @return array
     */
    public static function read(string $key = '')
    {
        $authArray = [];
        if ($authJson = @file_get_contents(self::getAuthFile())) {
            $authArray = json_decode($authJson, true);
        }
        return $key ? ($authArray[$key] ?? []) : $authArray;
    }
}