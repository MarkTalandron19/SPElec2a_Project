<?php
require_once('LibraryORM.php');
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

if (isset($_POST["submit"])) {
    $selected_option_value = $_POST['book'];
    $values = explode('|', $selected_option_value);
    $bookID = $values[0];
    $oldBranchID = $values[1];
    $newBranchID = $_POST['branch'];
    $date = date('Y-m-d');

    $arr = [
        'transferID' => 1,
        'bookID' => $bookID,
        'fromBranchID' => $oldBranchID,
        'toBranchID' => $newBranchID,
        'transferDate' => $date
    ];
    
    $transfer = $db->table('transfers')->insert($arr);
    echo "Transfer successful. Your request will now be reviewed.";
    echo "<a href=\"homepage.php\">Go back to home page.</a></br>";   

    unset($_POST);
}
?>