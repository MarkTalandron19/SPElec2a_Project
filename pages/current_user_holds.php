<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Home Page</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='..\css\current.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>

<?php
session_save_path('..\sessions');
session_start();
require_once('..\LibraryORM.php');
require_once('..\classes\Patron.php');
$patron = unserialize($_SESSION['user']);
$db = new LibraryORM('mysql:host=localhost;dbname=library', 'root', '', false);

$holds = $db->getUserHolds($patron->getID());
if (count($holds) > 0) {
    $db->printRows($holds);
} else {
    echo "You have no held books";
} 