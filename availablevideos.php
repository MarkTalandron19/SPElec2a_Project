<?php
//Page for outputting the videos in the library

require_once('LibraryORM.php');

$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

$videos = $db->select()->from('videos')->getAll();
$db->printRows($videos);
?>