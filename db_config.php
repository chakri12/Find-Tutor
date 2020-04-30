<?php
$servername = "localhost";
$username = "root";
$password = "Chakri@1999";
$db="webproject";
$link = new mysqli($servername, $username, $password,$db);
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} 
//echo "Connected successfully";
?>
