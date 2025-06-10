<?php
    include 'database.php';
    session_start();



    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];

        // echo $email. " " .$password;
        $sql = "SELECT * FROM user_table WHERE email = '$email' AND `password` = '$password'";
        $result = mysqli_query($conn, $sql);
    
        if( mysqli_num_rows($result) > 0){
            $data = mysqli_fetch_assoc($result);
            // print_r($data);
            $_SESSION['user'] = $data;
            header('location: /january/contact.php');
            exit;

        }else{
            echo "Invalid email or password";
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
    <h1>Login</h1>
    <form action="" method="post">
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Password" name="password">
        <button>Login</button>
    </form>
    <div>
        <a href="/january/signup.php">Don't have an account? Signup</a>
    </div>
</body>
</html>