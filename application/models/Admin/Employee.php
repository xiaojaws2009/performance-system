<?php
/**
 * Created by PhpStorm.
 * User: Error
 * Date: 2018/8/7
 * Time: 14:54
 */

namespace Admin;

use Db\JoyDb;

class EmployeeModel
{
    public static $tableName = "pre_employee";

    public static function getInstance()
    {
        return JoyDb::getInstance();
    }

    /**
     * 通过$account, $password获取一条数据
     * @param $account
     * @param $password
     * @return array|bool|mixed
     */
    public static function getRowByAccount($account, $password)
    {
        return self::getInstance()->get(self::$tableName, [
            'id',
            'name',
            'account',
            'group_id',
            'last_login_time',
            'last_login_ip',
        ],[
            'account' => $account,
            'password' => $password,
        ]);
    }

    public static function getOne($where)
    {
        return self::getInstance()->get(self::$tableName, '*', $where);
    }

    public static function getList($where)
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