<?php 
    // output commands
    // echo "Damilare";

    // variable declaration
    $name = "Ayomide";
    $age = 27;
    $height = 1.8;
    $isMarried = false;
    $rice = false;
    $beans = false;


    // concatenation
    // echo 'Hello, my name is '.$name;

    // echo "<h2> Hello, my name is $name. I am $age years old.  </h2>";

    // conditional statement
    // if ($isMarried){
    //     echo "$name is married";
    // }
    // else{
    //     echo "$name is not married";
    // }

    // if ($isMarried && $age >= 25){
    //     echo "$name is old enough to get married";
    // }
    // else if (!$isMarried && $age >= 25){
    //     echo "Why are you not married yet $name?";

    // }
    // else{
    //     echo "$name is not old enough to get married";
    // }

    // if ($rice && $beans){
    //     echo 'Buy rice and beans';
    // }
    // else if ($rice){
    //     echo 'Buy rice only';
    // }
    // else if ($beans){
    //     echo 'Buy beans only';
    // }
    // else{
    //     echo 'Come back home';
    // }


    $result = 'N/A';
    // if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //     // print_r($_POST);
    //     $score = $_POST['score'];
    //     $name = $_POST['name'];
    //     if ($score == null){
    //         $result = 'Input a valid score';
    //     }
    //     else{
    //         if ($score >=70 && $score <=100 ){
    //             $result = 'You passed the exam';
    //         }
    //         else{
    //             $result = 'You failed the exam';
    //         }
    //     }
    //     // echo "Your score is $score";
    // }   


    // Arrays
    // 1. indexed array

    // $students = array('Ayomide', 'Damilare', 'Tolu', 'Ola');
    $students = ['Ayomide', 'Damilare', 'Tolu', 'Ola'];
    // print_r($students);
    // echo $students[0]."<br>";
    // echo count($students)."<br>";


    // for ($i=0; $i < count($students); $i++) { 
    //     echo $students[$i]."<br>";
    // }

    // foreach ($students as $student) {
    //     echo $student."<br>";
    // }

    // array_push($students, 'Mayowa', 'Sk')
    // array_pop($students);
    // array_shift($students);
    // array_unshift($students, 'Mayowa');
    $new_arr = array_slice($students, 1, 2);
    // print_r($new_arr);
    // print_r($students);
    
    array_splice($students, 2,2, ['Mayowa', 'Sk']);
    // print_r($students);

    // 2. associative array
    $person = [
        "name" => "Damilare",
        "age" => 23,
        "gender" => "male",
        "isMarried" => true
    ];
    // print_r($person);
    // echo $person['name']."<br>";
    
    // 3. multidimensional array
    $user_details = [
        [
            "email" => "damilare@gmail.com",
            "password" =>"1234"
        ],
        [
            "email" => "ayo@gmail.com",
            "password" =>"1234"
        ],
        [
            "email" => "john@gmail.com",
            "password" =>"1234"
        ]
    ];

    for ($i=0; $i < count($user_details); $i++){
        // print_r($user_details[$i]['email']);
        // echo "<br>";
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
    <h4>Welcome to php class, <?php echo $name ?></h4>
    <form action="" method="post">
        <input type="text" placeholder="Name" name="name">
        <input type="number" placeholder="Score" name="score">
        <button>Submit</button>
    </form>

    <div>
        <b>Result:</b> <span> <?php echo $result; ?> </span>
    </div>



</body>
</html>
