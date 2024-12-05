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

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$library_card_number = $_POST['library_card_number'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO readers (first_name, last_name, library_card_number, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $first_name, $last_name, $library_card_number, $email);

if ($stmt->execute()) {
    echo '<div class="alert alert-success" role="alert">Читатель успешно зарегистрирован.</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Ошибка при регистрации читателя.</div>';
}

$stmt->close();
$conn->close();
?>
