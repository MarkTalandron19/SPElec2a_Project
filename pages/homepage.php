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
    <a href="page_cd_loan.php">View available music CDs and loan a CD</a></br>
    <a href="page_video_loan.php">View available videos and loan a video</a></br>
    <a href="page_holds.php">Request to hold a book</a></br>
    <a href="page_transfers.php">Request a book transfer</a></br>
    <a href="page_renew.php">Request a book renewal</a></br>
    <a href="current_user_book_loans.php">View loaned books</a></br>
    <a href="current_user_holds.php">View held books</a></br>
    <a href="current_user_transfers.php">View transfered books</a></br>
    <a href="current_user_cd_loans.php">View loaned music cds</a></br>
    <a href="current_user_video_loans.php">View loaned videos</a></br>
</body>

</html>