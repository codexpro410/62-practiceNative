<?php
/**
 * Exception Error handling url pages
 */

$GET_ROUTES = isset($routes['GET']) && is_array($routes['GET']) ? $routes['GET'] : [];
$POST_ROUTES = isset($routes['POST']) && is_array($routes['POST']) ? $routes['POST'] : [];
$pageFound = false;
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == 'GET') {
    foreach ($GET_ROUTES  as $rget) {
        if ($rget['segment'] == segment()) {
            $pageFound = true;
            // Execute the callback if it exists
            if (isset($rget['callback']) && is_callable($rget['callback'])) {
                call_user_func($rget['callback']);
            }
            break;
        }
    }
}
if ($requestMethod == 'POST') {
    foreach ($POST_ROUTES  as $rpost) {
        if ($rpost['segment'] == segment()) {
            $pageFound = true;
            // Execute the callback if it exists
            if (isset($rpost['callback']) && is_callable($rpost['callback'])) {
                call_user_func($rpost['callback']);
            }
            break;
        }
    }
}
$err404 = '<h1> 404 page not Found</h1>';
if (!$pageFound) {
    echo 'Exception Error.php '. $err404;
    exit();
}
