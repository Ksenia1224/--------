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

$loan_id = $_POST['loan_id'];
$return_date = date('Y-m-d');

$stmt = $conn->prepare("UPDATE loans SET return_date = ? WHERE id = ?");
$stmt->bind_param("si", $return_date, $loan_id);

if ($stmt->execute()) {
    echo '<div class="alert alert-success" role="alert">Книга успешно возвращена.</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Ошибка при возврате книги.</div>';
}

$stmt->close();
$conn->close();
?>
