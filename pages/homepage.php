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
    <link rel='stylesheet' type='text/css' media='screen' href='..\css\homepage.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>

<body>

    <div class="container">
    <img src="..\images\South Harmon Institue of Technology (1).png" alt="SHIT Logo">
        <h1>Welcome, <?php echo $patron->getFirstName() . ' ' . $patron->getLastName() ?></h1>
        <table>
            <tr>
                <td><i class="fas fa-book"></i><a href="page_loan.php">View available books and loan a book</a></td>
                <td><i class="fas fa-compact-disc"></i><a href="page_cd_loan.php">View available music CDs and loan a CD</a></td>
            </tr>
            <tr>
                <td><i class="fas fa-video"></i><a href="page_video_loan.php">View available videos and loan a video</a></td>
                <td><i class="fas fa-hand-holding-heart"></i><a href="page_holds.php">Request to hold a book</a></td>
            </tr>
            <tr>
                <td><i class="fas fa-exchange-alt"></i><a href="page_transfers.php">Request a book transfer</a></td>
                <td><i class="fas fa-redo-alt"></i><a href="page_renew.php">Request a book renewal</a></td>
            </tr>
            <tr>
                <td><i class="fas fa-book-reader"></i><a href="current_user_book_loans.php">View loaned books</a></td>
                <td><i class="fas fa-hand-holding"></i><a href="current_user_holds.php">View held books</a></td>
            </tr>
            <tr>
                <td><i class="fas fa-dolly-flatbed"></i><a href="current_user_transfers.php">View transferred books</a></td>
                <td><i class="fas fa-compact-disc"></i><a href="current_user_cd_loans.php">View loaned music CDs</a></td>
            </tr>
            <tr>
                <td><i class="fas fa-film"></i><a href="current_user_video_loans.php">View loaned videos</a></td>
            </tr>
        </table>
    </div>
</body>
</html>

