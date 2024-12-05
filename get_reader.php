<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_managements";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM readers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$reader = $result->fetch_assoc();

echo json_encode($reader);

$stmt->close();
$conn->close();
?>
