<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    $sql = "SELECT id, first_name, last_name, password, role FROM users WHERE email = ? OR first_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $first_name, $last_name, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $first_name . ' ' . $last_name;
            $_SESSION['user_role'] = $role; // Убедитесь, что сессия user_role установлена
            header("Location: index.php");
            exit();
        } else {
            echo "Неверный пароль.";
        }
    } else {
        echo "Пользователь не найден.";
    }

    $stmt->close();
    $conn->close();
}
?>
