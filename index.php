<?php 
    require_once("includes/app.php");
    session_start([
        'cookie_lifetime'=>config('session.timeout')
    ]);
    
    require_once("routes/web.php");
    require_once("includes/exceptionError.php");
    
    route_init();



// var_dump(db_insert('users',["name","email","password"],["ali1","b1k1V@example.com","1234"]));
// var_dump(db_update('users',["name","email"],["ali","ali2@yahoo.com"],15));
// var_dump(db_delete('users',19));
// var_dump(db_find('users',19));
// var_dump(db_search('users','name="islam" and email="easy@gmail.com"'));

// var_dump(db_searchMany('users','name="ali"'));
// firePaginate('users','name',2);

// SESSION
    // create session
    // delete session
    // delete all session

// MAIL
    // send mail
    // var_dump(sendMail(['b1k1V@example.com'], 'hi', 'hello world'));

// htaccess routing
