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

$search = isset($_POST['search']) ? $_POST['search'] : '';

$sql = "SELECT loans.id, books.title, CONCAT(readers.first_name, ' ', readers.last_name) AS full_name, DATE(loans.loan_date) AS loan_date, DATE(loans.due_date) AS due_date, loans.status FROM loans JOIN books ON loans.book_id = books.id JOIN readers ON loans.user_id = readers.id WHERE books.title LIKE ? OR readers.first_name LIKE ? OR readers.last_name LIKE ?";
$stmt = $conn->prepare($sql);
$searchParam = '%' . $search . '%';
$stmt->bind_param('sss', $searchParam, $searchParam, $searchParam);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $statusClass = '';
        if ($row["status"] == "Просрочена" || $row["status"] == "Утеряна") {
            $statusClass = 'text-danger';
        } elseif ($row["status"] == "Возвращена") {
            $statusClass = 'text-success';
        }
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["full_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["loan_date"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["due_date"]) . "</td>";
        echo "<td class='$statusClass'>" . htmlspecialchars($row["status"]) . "</td>";
        echo "<td>
                <select class='form-control status-select' data-loan-id='" . $row["id"] . "'>
                    <option value='Выдана' " . ($row["status"] == 'Выдана' ? 'selected' : '') . ">Выдана</option>
                    <option value='Просрочена' " . ($row["status"] == 'Просрочена' ? 'selected' : '') . ">Просрочена</option>
                    <option value='Утеряна' " . ($row["status"] == 'Утеряна' ? 'selected' : '') . ">Утеряна</option>
                    <option value='Возвращена' " . ($row["status"] == 'Возвращена' ? 'selected' : '') . ">Возвращена</option>
                </select>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Нет данных для отображения.</td></tr>";
}

$stmt->close();
$conn->close();
?>
