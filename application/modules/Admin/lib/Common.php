<?php

/**
 * @author Macro
 * @date 2018/8/24 14:31
 * @version 1.0.0
 */

namespace Admin\lib;

use Base\Utils;

class Common
{
    public static $quarterList = [
        1 => '第一季度',
        2 => '第二季度',
        3 => '第三季度',
        4 => '第四季度',
    ];

    /**
     * 生成菜单
     * @param $array
     * @return array
     */
    public static function buildMenu($array)
    {
        // 构造数据
        $items = array();
        foreach ($array as $value) {
            if ($value['is_show'] == 0) {
                continue;
            }
            $items[$value['id']] = $value;
        }
        return Utils::dataTree($items);
    }

}