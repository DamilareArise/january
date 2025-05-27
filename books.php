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
    'year' => ''
];
$title = '';
$author = '';
$year = '';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':

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

        if($title != '' && $author != '' && $year != ''){
            $book = [
                'title' => $title,
                'author' => $author,
                'year' => $year
            ];

            array_push($all_books, $book);
            $_SESSION['all_books'] = $all_books;

        }


        break;

    case 'GET':
        print_r($all_books);
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
</head>

<body>
    <div class="container-fluid mt-5 px-3" style="min-height:40dvh;">
        <div class="row">
            <div class="col-md-4 py-2 border">
                <form action="" method="post">
                    <h4 class="text-center">Add Book</h4>
                    <input type="text" class="form-control mb-2 shadow-none" value="<?php echo $title ?>" placeholder="Title" name="title">
                    <small class="text-danger"><?php echo $error['title'] ?></small>
                    <input type="text" class="form-control mb-2 shadow-none" value="<?php echo $author ?>" placeholder="Author" name="author">
                    <small class="text-danger"><?php echo $error['author'] ?></small>
                    <input type="text" class="form-control mb-2 shadow-none" value="<?php echo $year ?>" placeholder="Year" name="year">
                    <small class="text-danger"><?php echo $error['year'] ?></small>
                    <Button class="btn btn-dark w-100">Add</Button>
                </form>
            </div>
            <div class="col-md-8 border">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
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
                                    <td><?php echo $each['title'] ?></td>
                                    <td><?php echo $each['author'] ?></td>
                                    <td><?php echo $each['year'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
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