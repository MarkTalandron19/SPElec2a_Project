<?php
session_save_path('..\sessions');
session_start();
require_once('..\classes\Patron.php');
$patron = unserialize($_SESSION['user']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Home Page</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <h1>Welcome
        <?php echo $patron->getFirstName() . ', ' . $patron->getLastName() ?>
    </h1>
    <a href="page_loan.php">View available books and loan a book</a></br>
    <a href="page_holds.php">Request to hold a book</a></br>
    <a href="page_transfers.php">Request a book transfer</a></br>
    <a href="page_renew.php">Request a book renewal</a></br>
</body>

</html>