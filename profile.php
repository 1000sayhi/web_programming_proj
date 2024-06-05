<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";  
$dbname = "used_clothing_marketplace";

$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('login is needed.'); window.location.href = 'login.html';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $db->real_escape_string($_POST['name']);
    $email = $db->real_escape_string($_POST['email']);
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    $query = "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = '$user_id'";

    if ($db->query($query) === TRUE) {
        echo "<script>alert('profile is successfully updated.'); window.location.href = 'main.html';</script>";
    } else {
        echo "<script>alert('error.');</script>";
    }
}

$db->close();
?>
