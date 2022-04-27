<?php
$servername = "localhost";
$username = "Farooq";
$password = "farooqkhan1234";
$dbname = "recipes-food";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (! $conn) {
 // echo " Welidate <br>"; 
	 die("Connection failed: " . mysqli_connect_error());
}
?>