<?php
session_save_path('..\sessions');
session_start();
require_once('..\LibraryORM.php');
require_once('..\classes\Patron.php');
$patron = unserialize($_SESSION['user']);
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', '', false);

$loans = $db->getUserBookLoans($patron->getID());
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>User Book Loans</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='..\css\current.css'>
</head>

<body>
    <div class="container">
        <?php
        if (count($loans) > 0) {
            $db->printRows($loans);
        } else {
            echo "<h1>You have no loaned books</h1>";
        }
        ?>
        <a href="homepage.php">Go back to home page</a>
    </div>
</body>

</html>