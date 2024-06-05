<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "used_clothing_marketplace";


$db = new mysqli($servername, $username, $password, $database);


if ($db->connect_error) {
    die();
}


$query = "SELECT title, price, image FROM clothings";
$result = $db->query($query);

$clothings = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['image'] = base64_encode($row['image']); 
        $clothings[] = $row;
    }
}

echo json_encode($clothings);

$db->close();
?>
