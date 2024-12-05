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

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$library_card_number = $_POST['library_card_number'];
$email = $_POST['email'];

$stmt = $conn->prepare("UPDATE readers SET first_name = ?, last_name = ?, library_card_number = ?, email = ? WHERE id = ?");
$stmt->bind_param("ssssi", $first_name, $last_name, $library_card_number, $email, $id);

if ($stmt->execute()) {
    echo '<div class="alert alert-success" role="alert">Читатель успешно обновлен.</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Ошибка при обновлении читателя.</div>';
}

$stmt->close();
$conn->close();
?>
