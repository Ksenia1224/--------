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

$id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
$first_name = isset($_POST["first_name"]) ? strip_tags(trim($_POST["first_name"])) : '';
$last_name = isset($_POST["last_name"]) ? strip_tags(trim($_POST["last_name"])) : '';
$library_card_number = isset($_POST["library_card_number"]) ? strip_tags(trim($_POST["library_card_number"])) : '';
$email = isset($_POST["email"]) ? strip_tags(trim($_POST["email"])) : '';

$sql = "UPDATE readers SET first_name='$first_name', last_name='$last_name', library_card_number='$library_card_number', email='$email' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Данные читателя успешно обновлены.";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
