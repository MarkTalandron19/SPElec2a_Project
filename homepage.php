<?php
session_save_path('sessions');
session_start();
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
        <?php echo $_SESSION['firstName'] . ', ' . $_SESSION['lastName'] ?>
    </h1>
    <a href="loan_page.php">View available books and loan a book</a></br>
    <a href="holds_page.php">Request to hold a book</a></br>
    <a href="transfer_page.php">Request a book transfer</a>
</body>

</html>