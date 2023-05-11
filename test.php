<?php

// require_once('LibraryORM.php');
// $db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

// $user = $db->select()->from('patrons')->where('patronID', 1)->get();

// $db->printRows($user);

session_save_path('sessions');
session_start();

echo $_SESSION['firstName'];
?>