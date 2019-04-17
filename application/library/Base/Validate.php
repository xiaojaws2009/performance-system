<?php

/**
 * Validate and fitter params
 *
 * @author Macro
 * @date 2018/8/1 14:48
 * @version 1.0.0
 */

namespace Base;

class Validate
{
    public static function analyze($rules, $requestParams)
    {
        foreach ($rules as $rule) {
            if (count($rule) < 2) {
                Response::json(10001, "rule must not less than two element");
            }
            if (is_callable([new self(), $rule[1]])) {
                call_user_func_array([new self(), $rule[1]], [$rule, $requestParams]);
            } else {
                Response::json(10001, "no method callable");
            }
        }

        return true;
    }

    /**
     * check it is required
     *
     * ['name', 'required']
     * @param $rule
     * @param $requestParams
     * @throws \Yaf\Exception
     */
    public static function required($rule, $requestParams)
    {
        $names = [];
        !is_array($rule[0]) ? ($names[] = $rule[0]) : ($names = $rule[0]);

        foreach ($names as $name) {
            if (!isset($requestParams[$name])) {
                Response::json(10001, "{$name} must be set");
            }
        }
    }

    /**
     * check it is required
     *
     * ['name', 'notEmpty']
     * @param $rule
     * @param $requestParams
     * @throws \Yaf\Exception
     */
    public static function notEmpty($rule, $requestParams)
    {
        $names = [];
        !is_array($rule[0]) ? ($names[] = $rule[0]) : ($names = $rule[0]);

        foreach ($names as $name) {
            if (empty($requestParams[$name])) {
                Response::json(10001, "{$name} must not null");
            }
        }
    }

    /**
     * check it is a string
     *
     * @param $rule
     * @param $requestParams
     * @throws \Yaf\Exception
     */
    public static function string($rule, $requestParams)
    {
        if (empty($rule['length'])) {
            Response::json(10001, "length must be set");
        }

        $names = [];
        !is_array($rule[0]) ? ($names[] = $rule[0]) : ($names = $rule[0]);

        foreach ($names as $name) {
            $length = mb_strlen($requestParams[$name], 'UTF-8');

            if ($length < $rule['length'][0] || $length > $rule['length'][1]) {
                Response::json(10001, "length must between {$rule['length'][0]} ~ {$rule['length'][1]}");
            }
        }
    }

    /**
     * check it is the integer
     *
     * @param $rule
     * @param $requestParams
     * @throws \Yaf\Exception
     */
    public static function integer($rule, $requestParams)
    {
        $min = $max = 0;
        if (!empty($rule['length'])) {
            $min = $rule['length'][0];
            $max = $rule['length'][1];
        }

        $names = [];
        !is_array($rule[0]) ? ($names[] = $rule[0]) : ($names = $rule[0]);

        foreach ($names as $name) {
            if (!is_numeric($requestParams[$name])) {
                Response::json(10001, "{$name} must be number");
            }

            if ($min && $max) {
                if ($requestParams[$name] < $min || $requestParams[$name] > $max) {
                    Response::json(10001, "length overflows");
                }
            }
        }
    }

    /**
     * check it in list
     *
     * @param $rule
     * @param $requestParams
     * @throws \Yaf\Exception
     */
    public static function in($rule, $requestParams)
    {
        if (empty($rule['range'])) {
            Response::json(10001, "range must be set");
        }

        $names = [];
        !is_array($rule[0]) ? ($names[] = $rule[0]) : ($names = $rule[0]);

        foreach ($names as $name) {
            if (!in_array($requestParams[$name], $rule['range'])) {
                Response::json(10001, "{$name} not in the list");
            }
        }
    }
}
