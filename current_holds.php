<?php

require_once('LibraryORM.php');
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

$holds = $db->select()->from('holds')->getAll(); 
$db->printRows($holds);