<?php

$servername = "XXX";
$username = "XXX";
$password = "XXX";
$dbname = "XXX";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Charset UTF-8
mysqli_set_charset('utf8', $conn);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 