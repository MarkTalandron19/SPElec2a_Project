<?php
session_save_path('..\sessions');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Loan a Music CD</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='..\css\loan.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php
    require_once('..\LibraryORM.php');
    $db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', '', false);
    $result = $db->select()->from('cds')->getAll();


    if (count($result) > 0) {
        echo "<form method='post' action='process_book.php'>";
        echo "<table>";
        echo "<tr><th>Title</th><th>Artist</th><th>Release Year</th><th>Genre</th></tr>";

        foreach ($result as $row) {
            echo "<tr><td>" . $row["title"] .
                "</td><td>" . $row["artist"] .
                "</td><td>" . $row["releaseYear"] .
                "</td><td>" . $row["genre"] ;
        }

        echo "</table>";
        echo "</form>";
    } else {
        echo "0 results";
    }
    ?>
    <form method="post" action="process_cd_loan.php">
        <select name="cd" id="cd_loan">
            <?php
            foreach ($result as $row) {
                $value = $row["cdID"] . '|' . $row["branchID"];
                echo "<option value=" . $value . ">" . $row["title"] . "</option>";
            }
            ?>
            <input type='submit' value='submit' name='submit'>
        </select>
    </form>
</body>

</html>