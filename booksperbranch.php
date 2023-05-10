<?php
require_once('LibraryORM.php');
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);
$result = $db->getBooksPerBranch();


if (count($result) > 0) {
    echo "<form method='post' action='process_book.php'>";
    echo "<table>";
    echo "<tr><th>Branch Name</th><th>Title</th><th>Author</th><th>Publication Year</th><th>ISBN</th><th>Available Copies</th><th>Book ID</th><th>Branch ID</th><th>Available</th></tr>";

    $row_index = 0;
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
            "</td><td>" . $available .
            "</td><td><select name='selected_action'>";
        echo "<option value=''>Select option</option>";
        echo "<option value='loan'>Loan</option>";
        echo "<option value='hold'>Hold</option>";
        echo "</select>";
        echo "<input type='hidden' name='bookID[" . $row_index . "]' value='" . $row["bookID"] . "'>";
        echo "<input type='hidden' name='branchID[" . $row_index . "]' value='" . $row["branchID"] . "'>";
        echo "<input type='submit' value='Submit' name='submit'></td></tr>";
        $row_index++;
    }

    echo "</table>";
    echo "</form>";
} else {
    echo "0 results";
}
