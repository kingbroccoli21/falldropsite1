<?php
$user='root';
$password='';
$db='falldrop';

$db= new mysqli('localhost', $user, $password, $db)or die("unable to select database");

$connection = mysqli_connect('localhost', 'root', '');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'falldrop');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

?>
