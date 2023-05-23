<?php
session_save_path('..\sessions');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Loan a Video</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='..\css\loan.css'>
    <script src='main.js'></script>
</head>

<body>
<a href="homepage.php" class="back-button">Back</a>
    <?php
    require_once('..\LibraryORM.php');
    $db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', '', false);
    $result = $db->select()->from('videos')->getAll();


    if (count($result) > 0) {
        echo "<form method='post' action='process_book.php'>";
        echo "<table>";
        echo "<tr><th>Title</th><th>Director</th><th>Release Year</th><th>Format</th><th>Branch ID</th></tr>";

        foreach ($result as $row) {
            echo "<tr><td>" . $row["title"] .
                "</td><td>" . $row["director"] .
                "</td><td>" . $row["releaseYear"] .
                "</td><td>" . $row["format"] .
                "</td><td>" . $row["branchID"];
        }

        echo "</table>";
        echo "</form>";
    } else {
        echo "0 results";
    }
    ?>
    <form method="post" action="process_video_loan.php">
        <select name="video " id="cd_loan">
            <?php
            foreach ($result as $row) {
                $value = $row["videoID"] . '|' . $row["branchID"];
                echo "<option value=" . $value . ">" . $row["title"] . "</option>";
            }
            ?>
            <input type='submit' value='submit' name='submit'>
        </select>
    </form>
</body>

</html>