<?php 
    include 'index.php';
    include 'database.php';

    $contacts = new Contact($details);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .container{
            width: 200px; 
            background-color: whitesmoke; 
            margin: 10px; 
            padding: 5px;
        }
    </style>

    <div>
        <form action="/january/blog/add_contact.php" method="post">
            <input type="text" placeholder="Name" name="name">
            <input type="text" placeholder="Phone" name="phone">
            <button>add</button>
        </form>
    </div>

    <?php  foreach($contacts->fetch_all() as $index => $contact) { ?>
        <div class="container">
            <div><?php echo $contact['name'] ?></div>            
            <div><?php echo  $contact['phone'] ?></div>            
        </div>
    <?php } ?>
</body>
</html>