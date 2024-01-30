<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'Leonardo');
    define('DB_PASS', '123456');
    define('DB_NAME', 'penny_wise_db');

    // create 
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die('Connection failed ' . $conn->connect_error);
    }

?>