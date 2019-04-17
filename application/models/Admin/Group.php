<?php
/**
 * Created by PhpStorm.
 * User: Error
 * Date: 2018/8/7
 * Time: 14:54
 */

namespace Admin;

use Db\JoyDb;

class GroupModel
{
    public static $tableName = "pre_group";

    public static function getInstance()
    {
        return JoyDb::getInstance();
    }

    public static function getList($where = [])
    {
        return self::getInstance()->select(self::$tableName, '*', $where);
    }

}