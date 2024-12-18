<?php
header('Content-Type: application/json');
$mysqli = new mysqli("localhost", "root", "", "db_fawncoffee");

if ($mysqli->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
if (isset($data['name'], $data['price'])) {
    $name = $mysqli->real_escape_string($data['name']);
    $price = $mysqli->real_escape_string($data['price']);

    $query = "INSERT INTO cart (item_name, price) VALUES ('$name', '$price')";
    if ($mysqli->query($query)) {
        echo json_encode(["status" => "success", "message" => "Item added"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add item"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid data"]);
}

$mysqli->close();
?>
