<?php
// Start the session at the beginning of the script

// Update the connection string with the correct password
$servername = "localhost";
$username = "root";
$password = "Reach@12345"; // Set the password if it exists, otherwise leave it empty
$dbname = "tms_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
