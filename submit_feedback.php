<?php
session_start();

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

$name = isset($_POST["name"]) ? strip_tags(trim($_POST["name"])) : '';
$email = isset($_POST["email"]) ? strip_tags(trim($_POST["email"])) : '';
$message = isset($_POST["message"]) ? strip_tags(trim($_POST["message"])) : '';
$captcha = isset($_POST["captcha"]) ? intval($_POST["captcha"]) : 0;

// Проверка капчи
if ($captcha !== $_SESSION['captcha_num1'] + $_SESSION['captcha_num2']) {
    echo '<div class="alert alert-danger" role="alert">Неверная капча.</div>';
    exit;
}

// Handle file upload
$file_name = '';
if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/';
    $file_name = basename($_FILES['file']['name']);
    $upload_file = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
        echo '<div class="alert alert-success" role="alert">Файл успешно загружен.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Ошибка при загрузке файла.</div>';
        exit;
    }
}

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO feedback (name, email, message, file_name) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $message, $file_name);

if ($stmt->execute()) {
    echo '<div class="alert alert-success" role="alert">Ваше сообщение успешно отправлено.</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Ошибка при отправке сообщения.</div>';
}

$stmt->close();
$conn->close();
?>
