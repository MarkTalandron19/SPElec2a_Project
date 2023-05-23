<?php
session_save_path('..\sessions');
session_start();
require_once('..\classes\Patron.php');
$patron = unserialize($_SESSION['user']);

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
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
<form method="post">
            <button type="submit" name="logout" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    <div class="container">

    <img src="..\images\South Harmon Institue of Technology (1).png" alt="SHIT Logo">
        <h1>Welcome, <?php echo $patron->getFirstName() . ' ' . $patron->getLastName() ?></h1>


        <table>
        <tr>
            <td><button onclick="window.location.href='page_loan.php'"><i class="fas fa-book"></i> View available books and loan a book</button></td>
            <td><button onclick="window.location.href='page_cd_loan.php'"><i class="fas fa-compact-disc"></i> View available music CDs and loan a CD</button></td>
        </tr>
        <tr>
            <td><button onclick="window.location.href='page_video_loan.php'"><i class="fas fa-video"></i> View available videos and loan a video</button></td>
            <td><button onclick="window.location.href='page_holds.php'"><i class="fas fa-hand-holding-heart"></i> Request to hold a book</button></td>
        </tr>
        <tr>
            <td><button onclick="window.location.href='page_transfer.php'"><i class="fas fa-exchange-alt"></i> Request a book transfer</button></td>
            <td><button onclick="window.location.href='page_renew.php'"><i class="fas fa-redo-alt"></i> Request a book renewal</button></td>
        </tr>
        <tr>
            <td><button onclick="window.location.href='current_user_book_loans.php'"><i class="fas fa-book-reader"></i> View loaned books</button></td>
            <td><button onclick="window.location.href='current_user_holds.php'"><i class="fas fa-hand-holding"></i> View held books</button></td>
        </tr>
        <tr>
            <td><button onclick="window.location.href='current_user_transfers.php'"><i class="fas fa-dolly-flatbed"></i> View transferred books</button></td>
            <td><button onclick="window.location.href='current_user_cd_loans.php'"><i class="fas fa-compact-disc"></i> View loaned music CDs</button></td>
        </tr>
        <tr>
            <td><button onclick="window.location.href='current_user_video_loans.php'"><i class="fas fa-film"></i> View loaned videos</button></td>
        </tr>
        </table>

    </div>
</body>
</html>

