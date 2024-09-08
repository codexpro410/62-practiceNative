<?php

if (!function_exists('config')) {
    /**
     * Get a configuration value
     *
     * @param string $key
     *
     * @return mixed
     */
    function config($key) {
        $config = explode('.', $key);
        if (count($config) > 1) {
            $result = include base_path('config/' . $config[0].".php");
            return $result[$config[1]];
        }
    }
}
if  (!function_exists('base_path')) {
    function base_path($path) {
        // echo "helper.php". getcwd() . '/' . $path;
        return getcwd() . '/' . $path;
    }
}
