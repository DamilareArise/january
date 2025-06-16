<?php
    include 'database.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fullname = mysqli_real_escape_string($conn,($_POST['fullname']));
        $email = mysqli_real_escape_string( $conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        if($password === $confirm_password){
            $sql = "INSERT INTO user_table(`name`, email, `password`) VALUES ('$fullname', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "Registration Successfull";
            }else{
                echo "Registration Failed";
            }
        }else{
            echo "Passwords do not match";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Signup</h1>
    <form action="" method="post">
        <input type="text" name="fullname" placeholder="Fullname">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <button>Signup</button>
    </form>
</body>
</html>