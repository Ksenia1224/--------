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

$sql = "SELECT loans.id, books.title, CONCAT(readers.first_name, ' ', readers.last_name) AS full_name, loans.loan_date, loans.due_date, loans.return_date, loans.status FROM loans JOIN books ON loans.book_id = books.id JOIN readers ON loans.readers_id = readers.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $status = $row["status"] ?? 'Выдана';
        $statusClass = '';
        if ($status == 'Просрочена' || $status == 'Утеряна') {
            $statusClass = 'text-danger';
        }
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["full_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["loan_date"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["due_date"]) . "</td>";
        echo "<td>" . ($row["return_date"] ? htmlspecialchars($row["return_date"]) : 'Не возвращена') . "</td>";
        echo "<td class='$statusClass'>" . $status . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Нет данных для отображения.</td></tr>";
}

$conn->close();
?>
