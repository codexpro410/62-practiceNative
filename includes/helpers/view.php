<?php

if (!function_exists('view')) {
    function view($path) {
        if ($path === null) {
            echo "view.php Error: View path cannot be null.";
            return null;
        }
        $fullPath = str_replace('.', '/', $path);      
        $file = config('view.path') . '/' . $fullPath . '.php';
        if (file_exists($file)) {
            include $file;
        } else {
             $errorFile = config('view.path') . '/404.php';
            if (file_exists($errorFile)) {
                include $errorFile;
            } else {
                echo "view.php 404: View not found, and 404 page is missing.";
            }
        }
        return null;
    }
}
view('home');
