<?php
session_save_path('..\sessions');
session_start();
require_once('..\LibraryORM.php');
require_once('..\classes\Patron.php');
$patron = unserialize($_SESSION['user']);
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

$transfers = $db->select()->from('transfers')->where('patronID', $patron->getID())->getAll(); 
if (count($transfers) > 0) {
    $db->printRows($transfers);
} else {
    echo "You have no transfer requests";
} 