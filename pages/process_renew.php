<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Renew</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='..\css\process.css'>
    <script src='main.js'></script>
</head>

<?php
session_save_path('..\sessions');
session_start();
require_once('..\LibraryORM.php');
require_once('..\classes\Patron.php');
$patron = unserialize($_SESSION['user']);
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

if (isset($_POST["submit"])) {
    $bookID = $_POST['book'];
    $patronID = $patron->getID();
    $date = $_POST['renew'];

    $update = [
        'dueDate' => $date
    ];  

    $loans = $db->table('loans')->where('bookID', $bookID)->and('patronID', $patronID)->update($update);
    echo "Renewal request sent successful.";
    echo "<a href=\"homepage.php\">Go back to home page.</a></br>";

    unset($_POST);
}
?>
</html>