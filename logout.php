<?php
    session_start();
    session_destroy();
    header('location: /january/login.php')
?>