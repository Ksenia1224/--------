<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $library_card_number = $_POST['library_card_number'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хеширование пароля
    $role = $_POST['role'];

    // Проверка наличия пользователя с таким library_card_number
    $check_sql = "SELECT * FROM users WHERE library_card_number = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $library_card_number);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "Пользователь с таким номером читательского билета уже существует.";
        $check_stmt->close();
    } else {
        $sql = "INSERT INTO users (first_name, last_name, library_card_number, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $first_name, $last_name, $library_card_number, $email, $phone, $password, $role);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $first_name . ' ' . $last_name;
            $_SESSION['user_role'] = $role;
            header("Location: index.php");
            exit();
        } else {
            echo "Ошибка регистрации: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>
