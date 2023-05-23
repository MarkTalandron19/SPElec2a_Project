<?php
session_save_path('..\sessions');
session_start();

require_once('..\LibraryORM.php');
require_once('..\classes\Patron.php');
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', '', false);

if ($_POST) {
    $logInID = $_POST['patronID'];
    $logInPass = $_POST['password'];

    $user = $db->select()->from('patrons')->where('patronID', $logInID)->get();

    if ($user && count($user) == 1) {
        $user = $user[0];
        $patronID = $user['patronID'];
        $password = $user['password'];
        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $address = $user['address'];
        $phone = $user['phone'];
        $hasFines = $user['hasFines'];
        $patron = new Patron(
            $patronID,
            $password,
            $firstName,
            $lastName,
            $address,
            $phone,
            $hasFines
        );
        $_SESSION['user'] = serialize($patron);
        header('Location: homepage.php');
        exit();
    } else {
        $error = 'Patron does not exist';
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Log In</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='..\css\login.css'>

</head>

<body>
    <div class="container">
        <img src="..\images\South Harmon Institue of Technology.png" alt="SHIT Logo">
        <h1>Login</h1>
        <?php if (isset($error)) { ?>
            <p class="error-message">
                <?php echo $error; ?>
            </p>
        <?php } ?>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="patronID">Patron ID:</label>
                <input type="text" id="patronID" name="patronID">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <input type="submit" value="Log In">
            </div>
        </form>
    </div>
</body>

</html>
