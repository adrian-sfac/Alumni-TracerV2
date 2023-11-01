<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'alumnidb';


$db = new mysqli($servername, $username, $password, $dbname) or die($db->error);
$conn = new PDO( 'mysql:host=localhost;dbname=alumnidb', $username, $password );
if(!$conn){
die("Fatal Error: Connection Failed!");
}