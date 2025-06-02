<?php

session_start();

if (isset($_SESSION['all_books'])) {
    $all_books = $_SESSION['all_books'];
} else {
    $all_books = [];
}


$error = [
    'title' => '',
    'author' => '',
    'year' => '',
    'image' => ''
];

$title = '';
$author = '';
$year = '';

$message = '';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':

        // print_r($_POST);
        print_r($_FILES['image']);
        

        if ($_POST['title'] == '') {
            $error['title'] = 'Title field is required';
        } else {
            $title = $_POST['title'];
        }

        if ($_POST['author'] == '') {
            $error['author'] = 'Author field is required';
        } else {
            $author = $_POST['author'];
        }

        if ($_POST['year'] == '') {
            $error['year'] = 'Year field is required';
        } else {
            $year = $_POST['year'];
        }
    

        if($_POST['title'] != '' && $_POST['author'] != '' && $_POST['year'] != '' && $_POST['index'] != ''){
            $message = '';
            // edit functionality
            $index = intval($_POST['index']);
            $book = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'year' => $_POST['year']
            ];
            
            $all_books[$index] = $book;
            // or 
            // array_splice($all_books, $index, 1, [$book]);

            $_SESSION['all_books'] = $all_books;
            $title = '';
            $author = '';
            $year = '';

        }

        elseif ($title != '' && $author != '' && $year != ''){
            $message = '';
            // add functionality
            $book = [
                    'title' => $title,
                    'author' => $author,
                    'year' => $year
                ];

            if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK ){
                $image = $_FILES['image'];
                if($image['size'] > 1000000){
                    $error['image'] = 'File too large';
                }
                else if( !in_array($image['type'], ['image/jpeg', 'image/png']) ){
                    $error['image'] = 'Invalid image format';
                }
                else{
                    $file_name = time().'-'.$image['name'];
                    $tmp_path = $image['tmp_name'];
                    
                    $new_path = 'uploads/'.$file_name;
                    move_uploaded_file($tmp_path, $new_path);

                    $book['image_path'] = $new_path;

                    array_push($all_books, $book);
                    $_SESSION['all_books'] = $all_books;
                }


            }else{
                array_push($all_books, $book);
                $_SESSION['all_books'] = $all_books;
            }

            

            
            $title = '';
            $author = '';
            $year = '';
        } 


        break;

    case 'GET':
        // print_r($all_books);
        break;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid mt-5 px-3" style="min-height:40dvh;">
        <div class="row">
            <div class="col-md-4 py-2 border">
                <form action="" method="post" enctype="multipart/form-data">
                    <small class="text-center"><?php echo $message ?></small>
                    <h4 class="text-center">Add Book</h4>

                    <input type="text" class="form-control mb-2 shadow-none" value="<?php echo htmlspecialchars($title) ?>" placeholder="Title" name="title">
                    <small class="text-danger"><?php echo $error['title'] ?></small>

                    <input type="text" class="form-control mb-2 shadow-none" value="<?php echo $author ?>" placeholder="Author" name="author">
                    <small class="text-danger"><?php echo $error['author'] ?></small>


                    <input type="text" class="form-control mb-2 shadow-none" value="<?php echo $year ?>" placeholder="Year" name="year">
                    <small class="text-danger"><?php echo $error['year'] ?></small>
                    
                    <label for="" class="">Upload Book Cover Image</label>
                    <input type="file" class="form-control mb-2 shadow-none" accept="image/*" name="image" >
                    <small class="text-danger"><?php echo $error['image'] ?></small>

                    <Button class="btn btn-dark w-100">Add</Button>
                </form>
            </div>
            <div class="col-md-8 border">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Year</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($all_books) > 0) {?>
                            <?php foreach ($all_books as $index => $each) {?>
                                <tr>
                                    <th scope="row"><?php echo $index + 1 ?></th>
                                    <td>
                        
                                        <img src="<?php echo $each['image_path']??''  ?>" alt="cover" height="40">

                                        <!-- <?php if(isset($each['image_path'])) {?>
                                            <img src="<?php echo $each['image_path'] ?>" alt="" height="30">
                                        <?php } else { ?>
                                            <img src="" alt="Cover image" height="30">
                                        <?php } ?> -->
                                    </td>
                                    <td><?php echo $each['title'] ?></td>
                                    <td><?php echo $each['author'] ?></td>
                                    <td><?php echo $each['year'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="text-black text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <!-- Button trigger modal -->
                                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $index ?>" href="#">Edit</a></li>
                                                
                                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_<?php echo $index ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <h4 class="text-center">Edit <?php echo $each['title'] ?> </h4>
                                                <input type="hidden" value="<?php echo $index ?>" name="index">
                                                <input type="text" class="form-control mb-2 shadow-none" value="<?php echo $each['title'] ?>" placeholder="Title" name="title">
                                                <input type="text" class="form-control mb-2 shadow-none" value="<?php echo $each['author'] ?>" placeholder="Author" name="author">
                                                <input type="text" class="form-control mb-2 shadow-none" value="<?php echo $each['year'] ?>" placeholder="Year" name="year">
                                                <Button class="btn btn-dark w-100">Save Changes</Button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5" class="text-center">No book available</td>
                            </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
 

</body>

</html>