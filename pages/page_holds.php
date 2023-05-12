<?php
session_save_path('sessions');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Loan a Book</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php
    require_once('LibraryORM.php');
    $db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);
    $result = $db->getBooksPerBranch();


    if (count($result) > 0) {
        echo "<form method='post' action='process_book.php'>";
        echo "<table>";
        echo "<tr><th>Branch Name</th><th>Title</th><th>Author</th><th>Publication Year</th><th>ISBN</th><th>Available Copies</th><th>Book ID</th><th>Branch ID</th><th>Available</th></tr>";

        foreach ($result as $row) {
            $available = $row["Available"] ? "Yes" : "No";
            echo "<tr><td>" . $row["Branch Name"] .
                "</td><td>" . $row["Title"] .
                "</td><td>" . $row["Author"] .
                "</td><td>" . $row["Publication Year"] .
                "</td><td>" . $row["ISBN"] .
                "</td><td>" . $row["Available Copies"] .
                "</td><td>" . $row["bookID"] .
                "</td><td>" . $row["branchID"] .
                "</td><td>" . $available . "</td></tr>";
        }

        echo "</table>";
        echo "</form>";
    } else {
        echo "0 results";
    }
    ?>
    <form method="post" action="process_hold.php">
        <select name="book" id="hold">
            <?php
            foreach($result as $row)
            {
                $value = $row["bookID"] . '|' . $row["branchID"];
                echo "<option value=". $value . ">" . $row["Title"] . "</option>";
            }
            ?>
            <input type='submit' value='submit' name='submit'>
        </select>
    </form>
</body>

</html>