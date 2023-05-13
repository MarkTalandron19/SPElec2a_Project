<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Renew a Book</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php
    session_save_path('..\sessions');
    session_start();
    require_once('..\LibraryORM.php');
    $db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);
    $patronID = $_SESSION['patronID'];

    $loans = $db->select()->from('loans')->where('patronID', $patronID)->get();
    $books = $db->getUserLoans($patronID);
    ?>
    <?php
    if (count($loans) > 0) {
        $db->printRows($loans);
    ?>
        <form method="post" action="process_renew.php">
            <label for="book">Select book to renew:</label>
            <select name="book" id="book_renewal">
                <?php
                foreach ($books as $row) {
                    $value = $row["bookID"];
                    echo "<option value=" . $value . ">" . $row["title"] . "</option>";
                }
                ?>
            </select>
            <label for="renewal">
                Input date to set new renewal:
            </label>
            <input type="date" name="renew" id="renew">
            <input type='submit' value='submit' name='submit'>
        </form><?php
            } else {
                echo 'You have no loans.';
            }
                ?>
</body>

</html>