<?php
require_once 'includes/helpers/routing.php';
require_once 'includes/helpers/view.php';

route_get('/', 'home');
route_get('/articles', 'articles');
route_get('/art', 'art');
route_post('/users', function() {
    echo "This is the users page handling POST request.";
});
route_post('/tests', 'tests');


// 	/Php%20Anonymous%20course/62-practiceNative/
// echo '<pre>';
// var_dump(apache_get_modules());

// Call route_init() at the end of this file
// route_init();




