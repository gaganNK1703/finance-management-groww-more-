<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database="growwmore";


// Create connection
$conn =mysqli_connect($servername, $username, $password,$database);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error($conn));
}

?>
