<?php
// Initiate File
/**
 * Die Session des User muss in jedem php-file aufgeführt werden
 */
session_start();
/**
 * Sichert alle globalen Daten, die immer wieder gebraucht werden und bündelt
 * diese an einem Ort
 *
 */
$GLOBALS['config'] = [
    /**
     * Notwendige Angaben für DB-Verbindung
     */
    'mysql'=> [
        'host'=>'localhost',
        'username' => 'root',
        'password' => 'root',
        'db'=>'Accounts'
    ],
    /**
     * Sessionname wird später zu Username
     */
    'session' => [
        'session_name' => 'user'
    ]
];

/**
 * Autoload für alle Klassen
 */
spl_autoload_register(function ($class){
    require_once 'classes/'. $class . '.php';
});

/**
 * Bindet Header-Datei ein
 */
require_once 'header.php';

