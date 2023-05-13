<?php
session_save_path('..\sessions');
session_start();
require_once('..\LibraryORM.php');
require_once('..\classes\Patron.php');
$patron = unserialize($_SESSION['user']);
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

if (isset($_POST["submit"])) {
    $selected_option_value = $_POST['cd'];
    $values = explode('|', $selected_option_value);
    $cdID = $values[0];
    $branchID = $values[1];
    $patronID = $patron->getID();
    $date = date('Y-m-d');
    $dueDate = date('Y-m-d', strtotime('+5 days'));

    $arr = [
        'cdID' => $cdID,
        'branchID' => $branchID,
        'patronID' => $patronID,
        'loanDate' => $date,
        'dueDate' => $dueDate,
        'returnDate' => null
    ];
    
    $loan = $db->table('cd_loans')->insert($arr);

    unset($_POST);

    echo "Loan successful. Please retrieve the cd at the counter.";
    echo "<a href=\"homepage.php\">Go back to home page.</a></br>";   
}
?>