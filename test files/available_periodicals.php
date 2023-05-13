<?php
//Page for outputting the periodicals in the library

require_once('LibraryORM.php');

$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

$periodicals = $db->select()->from('periodicals')->getAll();
$db->printRows($periodicals);
?>