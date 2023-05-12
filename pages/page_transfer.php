<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Transfer a Book</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php
    require_once('..\LibraryORM.php');
    $db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);
    $result = $db->getBooksPerBranch();
    $branches = $db->select()->from('branches')->getAll();


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
    <form method="post" action="process_transfer.php">
        <label for="book">Select book to transfer:</label>
        <select name="book" id="book_transfer">
            <?php
            foreach ($result as $row) {
                $value = $row["bookID"] . '|' . $row["branchID"];
                echo "<option value=" . $value . ">" . $row["Title"] . "</option>";
            }
            ?>
        </select>
        <label for="branch">Select transfer branch:</label>
        <select name="branch" id="branch_transfer">
            <?php
            foreach($branches as $branch) {
                $value = $branch["branchID"];
                echo "<option value=" . $value . ">" . $branch["branchName"] . "</option>";
            }
            ?>
        </select>
        <input type='submit' value='submit' name='submit'>
    </form>
</body>

</html>