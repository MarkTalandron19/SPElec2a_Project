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
    $artist = $_POST['artist'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];   

    $arr = [
        'title' => $title,
        'artist' => $artist,
        'releaseYear' =>  $year,
        'genre' => $genre,
    ];
    
    $cd = $db->table('cds')->insert($arr);

    unset($_POST);

    echo "CD Added successfully.";
    echo "<a href=\"admin_home.php\">Go back to home page.</a></br>";   
}
?>

</body>

</html>