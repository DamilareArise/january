<?php
    include 'index.php';
    include 'database.php';

    $contacts = new Contact($details);
   

    $contacts->add_contact(
        $_POST['name'],
        $_POST['phone'],
    );

    header("location: /january/blog/page.php")
?>