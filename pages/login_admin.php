<?php
session_save_path('..\admin_sessions');
session_start();

require_once('..\LibraryORM.php');
require_once('..\classes\Admin.php');
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', '', false);

if ($_POST) {
    $logInID = $_POST['adminID'];
    $logInPass = $_POST['password'];

    $user = $db->select()->from('admins')->where('adminID', $logInID)->get();

    if ($user && count($user) == 1) {
        $user = $user[0];
        $adminID = $user['adminID'];
        $password = $user['password'];
        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $address = $user['address'];
        $phone = $user['phone'];
        $admin = new Admin(
            $adminID,
            $password,
            $firstName,
            $lastName,
            $address,
            $phone,
        );
        $_SESSION['admin'] = serialize($admin);
        header('Location: admin_home.php');
        exit();
    } else {
        $error = 'Admin does not exist';
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
        <form method="post" action="login_admin.php">
            <div class="form-group">
                <label for="adminID">Patron ID:</label>
                <input type="text" id="adminID" name="adminID">
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
