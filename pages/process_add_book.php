<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Process Loan</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='..\css\process.css'>
</head>

<body>

<?php
require_once('..\LibraryORM.php');
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', '', false);

if (isset($_POST["submit"])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];
    $copies = $_POST['available'];
    $branchID = $_POST['branchID'];    

    $arr = [
        'title' => $title,
        'author' => $author,
        'pubYear' =>  $year,
        'publisher' => $publisher,
        'isbn' => $isbn,
        'copiesAvailable' => $copies,
        'branchID' => $branchID,
    ];
    
    $book = $db->table('books')->insert($arr);

    unset($_POST);

    echo "Book Added successfully.";
    echo "<a href=\"admin_home.php\">Go back to home page.</a></br>";   
}
?>

</body>

</html>