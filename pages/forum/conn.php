<?php
session_start();
$username = 'root';
$password = '';
$conn = new PDO( 'mysql:host=localhost;dbname=alumnidb', $username, $password );
if(!$conn){
die("Fatal Error: Connection Failed!");
}

?>