<?php
// Настройки базы данных
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'library_managements');

// Соединение с базой данных
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
