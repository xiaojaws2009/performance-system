<?php
/**
 * Created by PhpStorm.
 * User: Error
 * Date: 2018/8/7
 * Time: 14:54
 */

namespace Admin;

use Db\JoyDb;

class RouteModel
{
    public static $tableName = "pre_route";

    public static function getInstance()
    {
        return JoyDb::getInstance();
    }

}