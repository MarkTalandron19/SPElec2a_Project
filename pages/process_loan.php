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
    $dueDate = date('Y-m-d', strtotime('+5 days'));

    $arr = [
        'bookID' => $bookID,
        'branchID' => $branchID,
        'patronID' => $patronID,
        'loanDate' => $date,
        'dueDate' => $dueDate,
        'returnDate' => null
    ];
    
    $loan = $db->table('loans')->insert($arr);

    unset($_POST);

    echo "Loan successful. Please retrieve the book at the counter.";
    echo "<a href=\"homepage.php\">Go back to home page.</a></br>";   
}
?>

</body>

</html>