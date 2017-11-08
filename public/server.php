#!/usr/bin/env php
<?php
define('APP_PATH', __DIR__ . '/../application/');
define('BIND_MODULE','push/Worker');
define('VIEW_PATH', __DIR__);
//define('EXTEND_PATH', __DIR__ .'/../application/common/extend/');
define('ROUTE_PATH', __DIR__ .'/../application/route/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';