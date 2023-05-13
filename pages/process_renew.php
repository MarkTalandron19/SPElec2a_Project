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
