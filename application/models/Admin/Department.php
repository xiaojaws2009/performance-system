<?php
/**
 * Created by PhpStorm.
 * User: Error
 * Date: 2018/8/7
 * Time: 14:54
 */

namespace Admin;

use Db\JoyDb;

class DepartmentModel
{
    public static $tableName = "pre_department";

    public static function getInstance()
    {
        return JoyDb::getInstance();
    }

    public static function getOne($where)
    {
        return self::getInstance()->get(self::$tableName, '*', $where);
    }

    public static function getList($where = [])
    {
        return self::getInstance()->select(self::$tableName, '*', $where);
    }

    public static function insert($data)
    {
        return self::getInstance()->insert(self::$tableName, $data);
    }

    public static function update($data, $where)
    {
        return self::getInstance()->update(self::$tableName, $data, $where);
    }

    public static function delete($where)
    {
        return self::getInstance()->delete(self::$tableName, $where);
    }

}