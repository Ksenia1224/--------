<?php
session_start();

if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    exit;
}

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

$book_id = isset($_POST["book_id"]) ? intval($_POST["book_id"]) : 0;
$user_id = $_SESSION['user_id'];
$rating = isset($_POST["rating"]) ? intval($_POST["rating"]) : 0;

// Проверка на существование оценки от этого пользователя для этой книги
$check_sql = "SELECT * FROM ratings WHERE book_id=$book_id AND user_id=$user_id";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    echo "Вы уже оценили эту книгу.";
} else {
    $sql = "INSERT INTO ratings (book_id, user_id, rating) VALUES ($book_id, $user_id, $rating)";
    if ($conn->query($sql) === TRUE) {
        echo "Спасибо за вашу оценку!";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
