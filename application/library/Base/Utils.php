<?php

/**
 * @author Macro
 * @date 2018/7/30 15:16
 * @version 1.0.0
 */

namespace Base;

class Utils
{
    /**
     * 下划线转驼峰, 如aa_bb_cc转成aaBbCc,注意首字母是小写。
     * @param $string
     * @param string $symbol 分隔符号,默认下划线
     * @param bool $ucFirst 首字母是否大写，默认小写
     * @return string
     */
    public static function underscoreToHump($string, $symbol = '_', $ucFirst = false)
    {
        if (strpos($string, $symbol) !== false) {
            $string = str_replace(' ', '', ucwords(str_replace($symbol, ' ', $string)));
            // $string = implode('', array_map('ucfirst', explode($symbol, $string)));

            return $ucFirst ? $string : lcfirst($string);
        }
        return $string;
    }

    /**
     * 获取客户端IP地址
     * 因为HTTP_CLIENT_IP和HTTP_X_FORWARDED_FOR不可信，所以只信任REMOTE_ADDR.如果来自代理，局域网的访问达到IP限制阈值，那么就调高阈值。
     * @param bool $trust 是否信任来自HTTP请求头里的IP地址。默认值false
     * @return string
     */
    public static function getIp($trust = true)
    {
        $clientIp = null;
        if ($trust) {
            $xip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '';
            $rip = $_SERVER['REMOTE_ADDR'] ?? '';
            if ($xip && strcasecmp($xip, 'unknown')) {
                $clientIp = $xip;
            } elseif ($rip && strcasecmp($rip, 'unknown')) {
                $clientIp = $rip;
            }
        }

        preg_match("/[\\d\\.]{7,15}/", $clientIp, $match);
        $clientIp = !empty($match[0]) ? $match[0] : '';
        return $clientIp;
    }

    /**
     * 生成分类树
     * @param $array
     * @return array
     */
    public static function dataTree($array)
    {
        $result = [];
        foreach ($array as $key => $item){
            if (isset($array[$item['parent_id']])) {
                $array[$item['parent_id']]['son'][] = &$array[$key];
            } else {
                $result[] = &$array[$key];
            }
        }
        return $result;
    }

    /**
     * 格式化数据
     * @param $array
     * @param $key
     * @param $valKey
     * @return array
     */
    public static function formatData($array, $key, $valKey)
    {
        $result = [];
        foreach ($array as $value) {
            $result[$value[$key]] = $value[$valKey];
        }
        return $result;
    }

}
