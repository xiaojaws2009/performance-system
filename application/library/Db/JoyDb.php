<?php

/**
 * joy-yaf DB Class,default use Medoo
 * @link https://medoo.lvtao.net/1.2/doc.php
 * @todo other ORM to be added，MySQL connection pool,asynchronous MySQL
 *
 *
 * @author Macro
 * @date 2018/7/25 15:36
 * @version 1.0.0
 */

namespace Db;

class JoyDb
{
    private static $instance = null;
    private static $databaseIdentity;
    private static $config;

    /**
     * @param string $databaseIdentity database identity
     * @param array $config database additional config
     * @return \Medoo\Medoo|null
     * @throws \Yaf\Exception
     */
    public static function getInstance($databaseIdentity = 'default', $config = [])
    {
        if (! $databaseIdentity) {
            throw new \Yaf\Exception("DB-Error: `databaseIdentity` must not null");
        }

        $databaseConfig = self::getDbConfig($databaseIdentity);
        $ORM = $databaseConfig['ORM'];

        if (null === self::$instance || $databaseIdentity != self::$databaseIdentity || $config != self::$config) {
            self::$instance = self::getORM($ORM, array_merge($databaseConfig[$ORM], $config));
            self::$databaseIdentity = $databaseIdentity;
            self::$config = $config;
        }

        return self::$instance;
    }

    private static function getORM($ORM, $config)
    {
        switch ($ORM) {
            case 'Medoo':
                return new \Medoo\Medoo($config);
            case '^-^Other^-^':
                // @todo other ORM to be added
                // no break
            default:
                throw new \Yaf\Exception("DB-Error: the ORM {$ORM} Is not supported");
        }
    }

    private static function getDbConfig($databaseIdentity)
    {
        if (empty($databaseConfig = \Yaf\Registry::get('config')->database->toArray())) {
            throw new \Yaf\Exception("DB-Error: database not configured");
        }
        if (!isset($databaseConfig[$databaseIdentity])) {
            throw new \Yaf\Exception("DB-Error: databaseIdentity `{$databaseIdentity}` is not set");
        }

        if (empty($defaultORM = $databaseConfig['default']['ORM'])) {
            throw new \Yaf\Exception("DB-Error: database default ORM is not set");
        }

        if (empty($databaseConfig[$databaseIdentity]['ORM'])) {
            $databaseConfig[$databaseIdentity]['ORM'] = $defaultORM;
        }

        return $databaseConfig[$databaseIdentity];
    }

}
