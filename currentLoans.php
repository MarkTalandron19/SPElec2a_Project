<?php

require_once('LibraryORM.php');
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

$loans = $db->select()->from('loans')->getAll(); 
$db->printRows($loans);