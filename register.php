<?php
$servername = "localhost";
$username = "root";
$password = "";  
$dbname = "used_clothing_marketplace";

$db = new mysqli($servername, $username, $password, $dbname);


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($db->query($query) === TRUE) {
        header("Location: login.html");
        exit();
    } else {
        echo "<script>alert('error.'); window.location.href = 'register.html';</script>";
    }

    $db->close();
}
?>
