<?php
require 'config.php';

// Пароль администратора
$admin_password = 'adminpass'; // Замените на фактический пароль администратора
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// Обновление пароля администратора в базе данных
$sql = "UPDATE users SET password = ? WHERE library_card_number = 'ADMIN123'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hashed_password);

if ($stmt->execute()) {
    echo "Пароль администратора успешно обновлен.";
} else {
    echo "Ошибка обновления пароля администратора: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
