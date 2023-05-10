<?php

require_once('LibraryORM.php');
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

var_dump($_POST); 

if (isset($_POST['submit'])) {
    foreach ($_POST['bookID'] as $row_index => $bookID) {
        $branchID = $_POST["branchID"][$row_index];
        $action = $_POST["selected_action"][$row_index];
        var_dump($bookID, $branchID, $action);

        $date = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime('+5 days'));
        if ($action == "loan") {
            $arr = [
                'loanID' => 1,
                'bookID' => $bookID,
                'branchID' => $branchID,
                'patronID' => 2,
                'loanDate' => $date,
                'dueDate' => $dueDate,
                'returnDate' => null
            ];
            $loan = $db->table('loans')->insert($arr);
        } else if ($action == "hold") {
            $query = "INSERT INTO holds (bookID, branchID, patronID, holdDate) VALUES (:bookID, :branchID, :patronID, :holdDate)";
        }
    }

    unset($_POST);
}