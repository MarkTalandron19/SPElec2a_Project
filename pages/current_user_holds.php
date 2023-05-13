<?php
session_save_path('..\sessions');
session_start();
require_once('..\LibraryORM.php');
require_once('..\classes\Patron.php');
$patron = unserialize($_SESSION['user']);
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

$holds = $db->select()->from('holds')->where('patronID', $patron->getID())->getAll();
if (count($holds) > 0) {
    $db->printRows($holds);
} else {
    echo "You have no held books";
} 