<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'Leonardo');
    define('DB_PASS', '123456');
    define('DB_NAME', 'php_dev');

    // create 
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


    // check
    // if ($conn->connect_error) {
    //     die('Connection failed ' . $conn->connect_error);
    // }

    // echo '<h2> connected </h2>';
    checkDbConnection($conn);
?>