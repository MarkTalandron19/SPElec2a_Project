<?php
//Page for outputting the cds in the library

require_once('LibraryORM.php');

$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

$cds = $db->select()->from('cds')->getAll();
$db->printRows($cds);
?>