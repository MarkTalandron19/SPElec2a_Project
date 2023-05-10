<?php
require_once('LibraryORM.php');
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);
$result = $db->getBooksPerBranch();

if (isset($_POST["submit"])) {
    $selected_option_value = $_POST['book'];
    $values = explode('|', $selected_option_value);
    $bookID = $values[0];
    $branchID = $values[1];
    $date = date('Y-m-d');

    $arr = [
        'holdID' => 1,
        'bookID' => $bookID,
        'branchID' => $branchID,
        'patronID' => 2,
        'holdDate' => $date
    ];
    
    $holds = $db->table('holds')->insert($arr);

    unset($_POST);
}
?>