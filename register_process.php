<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $library_card_number = $_POST['library_card_number'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (first_name, last_name, library_card_number, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $library_card_number, $email, $phone, $password, $role);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['username'] = $first_name . ' ' . $last_name;
        $_SESSION['role'] = $role;
        header("Location: index.php");
        exit();
    } else {
        echo "Ошибка регистрации: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
