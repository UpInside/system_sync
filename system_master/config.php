<?php
/**
 * Created by PhpStorm.
 * User: gustavoweb
 * Date: 11/06/2018
 * Time: 10:15
 */

/*
 * Config
 */
define('DATABASE', [
    'HOST' => 'localhost',
    'USER' => 'root',
    'PASS' => '',
    'NAME' => 'play_system_sync_master'
]);

/*
 * Autoload
 */
require_once __DIR__ . '/Source/Crud/Conn.php';
require_once __DIR__ . '/Source/Crud/Create.php';
require_once __DIR__ . '/Source/Crud/Read.php';
require_once __DIR__ . '/Source/Crud/Update.php';
require_once __DIR__ . '/Source/Crud/Delete.php';

require_once __DIR__ . '/Source/Model/Error.php';
require_once __DIR__ . '/Source/Model/OrderService.php';
require_once __DIR__ . '/Source/Model/Api.php';