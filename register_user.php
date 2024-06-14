<?php
// Connect to the database
$mysqli = new mysqli("localhost", "username", "password", "content_library");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve and sanitize user inputs
$username = $mysqli->real_escape_string($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert the new user into the database
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($mysqli->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>
