<?php

$routes = [];
// write your ownpath of the prject here
$basePath = '/Php%20Anonymous%20course/62-practiceNative';
$SERVER_REQUEST_URI = substr($_SERVER['REQUEST_URI'], strlen($basePath));

// Register a GET route
function route_get($segment, $view) {
    global $routes;
    $routes['GET'][$segment] = $view;
}

// Register a POST route
function route_post($segment, $view) {
    global $routes;
    $routes['POST'][$segment] = $view;
}

// Initialize the router
function route_init() {
    global $routes;
    global $SERVER_REQUEST_URI;
    
    $method = $SERVER_REQUEST_URI;

    $currentSegment = segment();

    // Check if a route matches for the current method and segment
    if (isset($routes[$method][$currentSegment])) {
        $view = $routes[$method][$currentSegment];

        if (is_callable($view)) {
            call_user_func($view);
        } else {
            // Otherwise, use the `view()` function to load the view file
            view($view);
        }
        exit();
    }

    header("HTTP/1.0 404 Not Found");
    echo "routing.php Error 404: Page not found";
    exit();
}

// Function to get the current segment from the URL
function segment() {
    global $SERVER_REQUEST_URI;
    global $basePath;

    // Remove the base path from the request URI to get the actual segment
    $uri = $SERVER_REQUEST_URI;
    $segment = str_replace($basePath, '', $uri);
    return '/' . trim($segment, '/');
}

// Example route definitions
route_get('/', 'home');
route_get('/articles', 'articles');
route_get('/art', 'art');
route_post('/users', function() {
    echo "This is the users page handling POST request.";
});
route_post('/tests', 'tests');

// Initialize the routes
// route_init();
