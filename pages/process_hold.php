<?php
session_save_path('..\sessions');
session_start();
require_once('..\LibraryORM.php');
require_once('..\classes\Patron.php');
$patron = unserialize($_SESSION['user']);
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

if (isset($_POST["submit"])) {
    $selected_option_value = $_POST['book'];
    $values = explode('|', $selected_option_value);
    $bookID = $values[0];
    $branchID = $values[1];
    $patronID = $patron->getID();
    $date = date('Y-m-d');

    $arr = [
        'bookID' => $bookID,
        'branchID' => $branchID,
        'patronID' => $patronID,
        'holdDate' => $date
    ];
    
    $holds = $db->table('holds')->insert($arr);
    echo "Hold successful.";
    echo "<a href=\"homepage.php\">Go back to home page.</a></br>";   

    unset($_POST);
}
?>