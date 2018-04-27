<?php
if (!function_exists("__d")) {
    function __d($var, $caller = null)
    {
        if (!config("app.debug"))
            return false;

        if(!isset($caller)){
            $caller = debug_backtrace(1);
            $caller = array_shift($caller);
        }
        $call = '<code>File: '.$caller['file'].' / Line: '.$caller['line'].'</code>';
        dump($call);
        dump($var);
    }
}

if (!function_exists("__dd")) {
    function __dd($var)
    {
        $caller = debug_backtrace(1);
        $caller = array_shift($caller);
        __d($var,$caller);
        die();
    }
}