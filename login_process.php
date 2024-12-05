<?php
session_start();
require 'db_connect.php';

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

        if ($role == 'admin' && $password == $hashed_password) {
            // Проверка пароля в открытом виде для администратора
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $first_name . ' ' . $last_name;
            $_SESSION['role'] = $role;
            header("Location: index.php");
            exit();
        } elseif (password_verify($password, $hashed_password)) {
            // Проверка хешированного пароля для обычных пользователей
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $first_name . ' ' . $last_name;
            $_SESSION['role'] = $role;
            header("Location: index.php");
            exit();
        } else {
            echo "Неверный пароль.";
            echo "<br>Hashed password from DB: " . $hashed_password;
            echo "<br>Entered password: " . $password;
        }
    } else {
        echo "Пользователь не найден.";
    }

    $stmt->close();
    $conn->close();
}
?>
