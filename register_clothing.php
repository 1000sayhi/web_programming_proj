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
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $db->real_escape_string($_POST['title']);
    $description = $db->real_escape_string($_POST['description']);
    $price = $db->real_escape_string($_POST['price']);
    $user_id = $_SESSION['user_id'];

    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    $query = "INSERT INTO clothings (user_id, title, description, price, image) VALUES ('$user_id', '$title', '$description', '$price', '$image')";

    if ($db->query($query) === TRUE) {
        echo "<script>alert('clothing registered.'); window.location.href = 'main.html';</script>";
        exit();
    } else {
        echo "<script>alert('error.'); window.location.href = 'main.html';</script>";
    }
}

$db->close();
?>
