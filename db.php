<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_manager";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully to contact_manager"; // Optional message, you can remove it if you don't need it.
?>
