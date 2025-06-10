<?php
    // $arr = ['ade', 'ola', 'femi']
    // array_splice($arr, 1, 1,  )

    session_start();
    // session_destroy();

    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }else{
        header('location: /january/login.php');
        exit;
    }

    if (isset($_SESSION['contacts'])){
        $contacts = $_SESSION['contacts'];
    }else{
        $contacts = [];
    }

    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['contact_name']) && $_POST['contact_name'] != '' ) {
            $name = $_POST['contact_name'];
            array_push($contacts, $name);
            $_SESSION['contacts'] = $contacts;
            // print_r($contacts);
            
        }
        else if (!empty($_POST['new_name']) && $_POST['index'] != ''){
            // print_r($_POST['index']);

            $new_name = $_POST['new_name'];
            $index = $_POST['index'];
            array_splice($contacts, $index, 1, $new_name);
            $_SESSION['contacts'] = $contacts;
        }
        else{
            $message = '<b class="text-danger">Empty entry</b>';

        }
    }
    else{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $contacts = $_SESSION['contacts'];
            array_splice($contacts, $id, 1);
            $_SESSION['contacts'] = $contacts;

            header('location: /january/contact.php');
        }
        else if(isset($_GET['action'])){
            // echo $_GET['action'];
            if ($_GET['action'] == 'all'){
                $_SESSION['contacts'] = [];

                header('location: /january/contact.php');
            } 
        }
        
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    
    <!-- contact list -->
    <div class="container col-md-5 border my-3 p-2">
    <form action="" method="post" class="d-flex flex-column gap-1">
        <p class="text-center"><?php echo $message ?></p>
        <h5 class="text-center">Add Contact</h5>
        <input type="text" class="form-control my-2 shadow-none" placeholder="Name" name="contact_name">
        <button class="btn btn-dark ">Submit</button>
    </form>
    <div class="container my-2 border" style="min-height: 20dvh;">
        <?php if(count($contacts) > 0) {?>
            <ul>
                <?php foreach($contacts as $index => $contact) {?>
                    <li> 
                        <?php echo $contact ?> <a href="/january/contact.php/?id=<?php echo $index ?>" class="text-decoration-none">❌</a>

                        <!-- Button trigger modal -->
                        <a type="button" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $index ?>">
                        📝
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal_<?php echo $index ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            
                            <div class="modal-body">
                               <form action="" method="post" class="d-flex flex-column gap-1">
                                    <h5 class="text-center">Edit Contact</h5>
                                    <input type="text" value="<?php echo $contacts[$index] ?>" class="form-control my-2 shadow-none" placeholder="Name" name="new_name">
                                    <input type="hidden" value="<?php echo $index ?>" name="index">
                                    <button class="btn btn-dark" data-bs-dismiss="modal">Edit</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                    </li>
                    
                <?php } ?>
            </ul>

            <a href="/january/contact.php/?action=all" class="btn btn-danger mb-2">Clear all</a>
        <?php } else { ?>
            <p>No contact available</p>
        <?php } ?>
        
    </div>

    </div>
    
    <div>
        <a href="/january/logout.php" class="btn btn-dark ms-3">Logout</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>