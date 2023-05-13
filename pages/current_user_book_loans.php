<?php
session_save_path('..\sessions');
session_start();
require_once('..\LibraryORM.php');
require_once('..\classes\Patron.php');
$patron = unserialize($_SESSION['user']);
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', 'root', false);

$loans = $db->select()->from('loans')->where('patronID', $patron->getID())->getAll();
if (count($loans) > 0) {
    $db->printRows($loans);
} else {
    echo "You have no loaned books";
}
