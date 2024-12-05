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

$stmt = $conn->prepare("DELETE FROM readers WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo '<div class="alert alert-success" role="alert">Читатель успешно удален.</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Ошибка при удалении читателя.</div>';
}

$stmt->close();
$conn->close();
?>
