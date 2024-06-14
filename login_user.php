<?php
// Connect to the database
$mysqli = new mysqli("localhost", "username", "password", "content_library");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve and sanitize user inputs
$username = $mysqli->real_escape_string($_POST['username']);
$password = $_POST['password'];

// Check the credentials
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo "Login successful!";
        // Start session and set user info
        session_start();
        $_SESSION['username'] = $username;
        header("Location: library.html");
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that username.";
}

$mysqli->close();
?>
