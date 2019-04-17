<?php
/**
 * Created by PhpStorm.
 * User: Error
 * Date: 2018/8/7
 * Time: 14:54
 */

namespace Admin;

use Db\JoyDb;

class PerformanceModel
{
    public static $tableName = "pre_performance";

    public static function getInstance()
    {
        return JoyDb::getInstance();
    }

    /**
     * 生成where条件
     * @param $where
     * @return string
     */
    private static function buildWhere($where)
    {
        $whereStr = "1";
        if (isset($where['year'])) {
            $whereStr .= " AND year='{$where['year']}'";
        }
        if (isset($where['quarter'])) {
            $whereStr .= " AND quarter='{$where['quarter']}'";
        }
        if (isset($where['manager_id'])) {
            $whereStr .= " AND manager_id='{$where['manager_id']}'";
        }
        if (!empty($where['employee_id'])) {
            $whereStr .= " AND employee_id='{$where['employee_id']}'";
        }
        return $whereStr;
    }

    /**
     * 获取详细
     * @param $where
     * @return array
     */
    public static function getDetail($where)
    {
        $whereStr = self::buildWhere($where);
        if (!empty($where['employee_name'])) {
            $whereStr .= " AND b.name LIKE '%{$where['employee_name']}%'";
        }
        $sql = "SELECT b.name AS employee_name,c.name AS manager_name,a.year,a.quarter,a.employee_id,
            a.ability_score,a.attitude_score,a.leadership_score,a.total_score,a.create_time
            FROM ".self::$tableName." a
            LEFT JOIN ".EmployeeModel::$tableName." b ON b.id=a.employee_id
            LEFT JOIN ".EmployeeModel::$tableName." c ON c.id=a.manager_id
            WHERE {$whereStr}
            ORDER BY total_score DESC";
        return self::getInstance()->query($sql)->fetchAll();
    }

    /**
     * 获取经理季度排名
     * @param $where
     * @return array
     */
    public static function getRank($where)
    {
        $whereStr = self::buildWhere($where);
        $sql = "SELECT b.name AS manager_name,year,quarter,a.manager_id,
            SUM(ability_score) AS ability_score,SUM(attitude_score) AS attitude_score,
            SUM(leadership_score) AS leadership_score,SUM(total_score) AS total_score
            FROM ".self::$tableName." a
            LEFT JOIN ".EmployeeModel::$tableName." b ON b.id=a.manager_id
            WHERE {$whereStr}
            GROUP BY manager_id,year,quarter
            ORDER BY total_score DESC,manager_name ASC";
        return self::getInstance()->query($sql)->fetchAll();
    }

    /**
     * 季度总排名
     * @param $where
     * @return array
     */
    public static function getRankGroupByQuarter($where)
    {
        $whereStr = self::buildWhere($where);
        $sql = "SELECT year,quarter,count(DISTINCT manager_id) as manager_num,count(DISTINCT employee_id) as employee_num,
            SUM(ability_score) AS ability_score,SUM(attitude_score) AS attitude_score,
            SUM(leadership_score) AS leadership_score,SUM(total_score) AS total_score
            FROM ".self::$tableName."
            WHERE {$whereStr}
            GROUP BY year,quarter
            ORDER BY year DESC,quarter DESC";
        return self::getInstance()->query($sql)->fetchAll();
    }

    public static function getOne($where)
    {
        return self::getInstance()->get(self::$tableName, '*', $where);
    }

    public static function insert($data)
    {
        return self::getInstance()->insert(self::$tableName, $data);
    }

}