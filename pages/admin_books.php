<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Loan a Book</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='..\css\loan.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php
    require_once('..\LibraryORM.php');
    $db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', '', false);
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

    <h1>Add New Book</h1>
    <form method="post" action="process_add_book.php">
        <label for="title">Book Title </label>
        <input type="text" name="title" id="title">
        <label for="author">Author </label>
        <input type="text" name="author" id="author">
        <label for="publisher">Publisher </label>
        <input type="text" name="publisher" id="publisher">
        <label for="year">Publication Year </label>
        <input type="text" name="year" id="year">
        <label for="isbn">ISBN </label>
        <input type="text" name="isbn" id="isbn">
        <label for="available">Copies Obtained </label>
        <input type="number" name="available" id="available" min="1">
        <label for="branchID">Branch ID </label>
        <input type="text" name="branchID" id="branchID">
        <input type='submit' value='Submit' name='submit'>
    </form>
</body>

</html>