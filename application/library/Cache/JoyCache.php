<?php

/**
 * joy-yaf Cache Class,default use phpredis extension
 * @link https://github.com/phpredis/phpredis/
 * @todo Redis connection pool
 *
 *
 * @author Macro
 * @date 2018/7/28 21:32
 * @version 1.0.0
 */

namespace Cache;

use Yaf\Registry;
use Yaf\Exception;

class JoyCache
{
    private static $instance = null;
    private static $cacheIdentity;
    private static $config;

    /**
     * @param string $cacheIdentity cache identity
     * @param array $config cache additional config
     * @return null|Redis
     * @throws \Yaf\Exception
     */
    public static function getInstance($cacheIdentity = 'default', $config = [])
    {
        if (! $cacheIdentity) {
            throw new Exception("Cache-Error: `cacheIdentity` must not null");
        }

        $cacheConfig = self::getCacheConfig($cacheIdentity);
        $system = $cacheConfig['system'];

        try {
            $reNew = false;
            if (self::$instance && self::$instance->ping() == '+PONG') {

            }
        } catch (Exception $e) {
            $reNew = true;
        }

        if ($reNew || null === self::$instance || $cacheIdentity != self::$cacheIdentity || $config != self::$config) {
            self::$instance = self::getSystem($system, array_merge($cacheConfig[$system], $config));
            self::$cacheIdentity = $cacheIdentity;
            self::$config = $config;
        }

        return self::$instance;
    }

    private static function getSystem($system, $config)
    {
        switch ($system) {
            case 'phpredis':
                $obj = new Redis(empty($config['keyPrefix']) ? '' : $config['keyPrefix']);
                if (!empty($config['persistent']) && $config['persistent'] == 1) {
                    $obj->pconnect($config['host'], $config['port'], $config['timeout']);
                } else {
                    $obj->connect($config['host'], $config['port'], $config['timeout']);
                }
                $obj->auth($config['password']);
                $obj->select(isset($config['database']) ? $config['database'] : 0);
                return $obj;
            case '^-^Other^-^':
                // @todo other Cache to be added
                // no break
            default:
                throw new Exception("Cache-Error: the Cache {$system} Is not supported");
        }
    }

    private static function getCacheConfig($cacheIdentity)
    {
        if (empty($cacheConfig = Registry::get('config')->cache->toArray())) {
            throw new Exception("Cache-Error: cache not configured");
        }
        if (!isset($cacheConfig[$cacheIdentity])) {
            throw new Exception("Cache-Error: cacheIdentity `{$cacheIdentity}` is not set");
        }

        if (empty($defaultCache = $cacheConfig['default']['system'])) {
            throw new Exception("Cache-Error: cache default ORM is not set");
        }

        if (empty($cacheConfig[$cacheIdentity]['system'])) {
            $databaseConfig[$cacheIdentity]['system'] = $defaultCache;
        }

        return $cacheConfig[$cacheIdentity];
    }

}
