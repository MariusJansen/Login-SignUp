<?php
// Initiate File
/**
 * Die Session des User muss in jedem php-file aufgeführt werden
 */
session_start();
/**
 * Sichert alle globalen Daten und bündelt diese an einem Ort
 */
$GLOBALS['config'] = [
    'mysql'=> [
        'host'=>'localhost',
        'username' => 'root',
        'password' => 'root',
        'db'=>'Accounts'
    ],
    'session' => [
        'session_name' => 'user'
    ]
];

spl_autoload_register(function ($class){
    require_once 'classes/'. $class . '.php';
});

require_once 'header.php';

