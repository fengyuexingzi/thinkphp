<?php
/**
 * Created by PhpStorm.
 * User: Wind
 * Date: 2017/10/30
 * Time: 15:37
 */
// [ 应用入口文件 ]
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

//资源相对路径 ...html资源路径与php文件路径不同，如：
//html  localhost/think/public/favicon.ico
//php   d:/www/think/public/extend.php
//  相对路径时两者通用，但是 php 许多函数引入文件必须使用全路径 eg;(file_get_contents())
define('RELATIVE_PATH', dirname($_SERVER["SCRIPT_NAME"]));

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

//消除缓存
//clearTemp(RUNTIME_PATH);