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

$book_id = $_POST['book_id'];
$readers_id = $_POST['readers_id'];
$due_date = $_POST['due_date'];
$loan_date = date('Y-m-d');
$status = "Выдана";

$stmt = $conn->prepare("INSERT INTO loans (book_id, readers_id, loan_date, due_date, status) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $book_id, $readers_id, $loan_date, $due_date, $status);

if ($stmt->execute()) {
    echo '<div class="alert alert-success" role="alert">Книга успешно выдана.</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Ошибка при выдаче книги: ' . $stmt->error . '</div>';
}

$stmt->close();
$conn->close();
?>
