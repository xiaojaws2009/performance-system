<?php

/**
 * dev environment entrance
 *
 * @author Macro
 * @date 2018/7/17 17:55
 * @version 1.0.0
 */

// The global library path
define('APP_PATH', dirname(__DIR__));
define('YAF_VERSION', YAF\VERSION);
define('YAF_ENV', YAF\ENVIRON);
define('DEBUG', 0);

// 自动加载第三方类库
\Yaf\Loader::import(APP_PATH . "/vendor/autoload.php");

$app = new Yaf\Application(APP_PATH . "/conf/application.ini");
$app->bootstrap()->run();
