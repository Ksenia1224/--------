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

$sql = "SELECT loans.id, books.title, users.username, users.email, loans.due_date FROM loans JOIN books ON loans.book_id = books.id JOIN users ON loans.user_id = users.id WHERE loans.return_date IS NULL AND loans.due_date < NOW()";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $to = $row["email"];
        $subject = "Уведомление о просроченной книге";
        $message = "Уважаемый(ая) " . $row["username"] . ",\n\nКнига \"" . $row["title"] . "\" просрочена. Пожалуйста, верните её как можно скорее.\n\nС уважением,\nБиблиоМир";
        $headers = "From: no-reply@bibliomir.com";
        mail($to, $subject, $message, $headers);
    }
}

$conn->close();
?>
