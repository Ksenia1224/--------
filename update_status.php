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

$loanId = $_POST['loanId'];
$newStatus = $_POST['newStatus'];

$stmt = $conn->prepare("UPDATE loans SET status = ? WHERE id = ?");
$stmt->bind_param("si", $newStatus, $loanId);

if ($stmt->execute()) {
    echo '<div class="alert alert-success" role="alert">Статус успешно обновлен.</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Ошибка при обновлении статуса.</div>';
}

$stmt->close();
$conn->close();
?>
