<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Loan a Music CD</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- <link rel='stylesheet' type='text/css' media='screen' href='..\css\loan.css'> -->
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
                "</td><td>" . $row["genre"] .
                "</td><td>" . $row["branchID"];
        }

        echo "</table>";
        echo "</form>";
    } else {
        echo "0 results";
    }
    ?>
    <h1>Add Music CD</h1>
    <form method="post" action="process_add_cd.php">
        <label for="title">CD Title: </label>
        <input type="text" name="title" id="title"><br>
        <label for="artist">Artist: </label>
        <input type="text" name="artist" id="artist"><br>
        <label for="year">Release Year: </label>
        <input type="text" name="year" id="year"><br>
        <label for="genre">Genre: </label>
        <input type="text" name="genre" id="genre"><br>
        <input type='submit' value='Submit' name='submit'>
    </form>
</body>

</html>