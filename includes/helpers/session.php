<?php
if (!function_exists("session")) {
    function session($key, $value=null){
        if (!is_null($value)) {
        $_SESSION[$key] = $value;
        }   
        return isset($_SESSION[$key])?$_SESSION[$key]:'';
    }
}

if (!function_exists("sessionFlush")) {
    function sessionFlush($key){
        $_SESSION[$key] = null;
     }
}

if (!function_exists("sessionFlushAll")) {
    function sessionFlushAll(){
        session_destroy();
     }
}