<?php
    //  connect with database
    $host = 'localhost';
    $user = 'root';
    $password = 'password';
    $database = 'dignity_db';

    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn) {
        die('Error connecting to database: ' . mysqli_connect_error());
    }
?>