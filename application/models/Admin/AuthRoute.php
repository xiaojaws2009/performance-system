<?php
/**
 * Created by PhpStorm.
 * User: Error
 * Date: 2018/8/7
 * Time: 14:54
 */

namespace Admin;

use Db\JoyDb;

class AuthRouteModel
{
    public static $tableName = "pre_auth_route";

    public static function getInstance()
    {
        return JoyDb::getInstance();
    }

    /**
     * 通过group_id获取数据
     * @param $group_id
     * @return array|bool|mixed
     */
    public static function getRowByGroupId($group_id)
    {
        return self::getInstance()->select(self::$tableName, [
            "[>]" . RouteModel::$tableName . "(b)" => ["route_id" => "id"],
        ], [
            "id",
            "name",
            "path",
            "parent_id",
            "is_show",
            "icon",
        ], [
            'group_id' => $group_id,
        ]);
    }

}