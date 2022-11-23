<?php

class Config
{
    public static function get($path = null){
        if($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach ($path as $bit){
                if(isset($config[$bit])) {
                    /**
                     * Um auch die geschachtelten Bereiche zu erreichen, wird nach jeder isset-Überprüfung
                     * $config mit $config[$bit] gleichgesetzt
                     *
                     * Bsp: config -> mysql -> host
                     *
                     */
                    $config = $config[$bit];
                }
            }
            return $config;
        }
    }
}