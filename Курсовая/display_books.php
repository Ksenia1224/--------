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

$sql = "SELECT id, title, author, year, isbn, publisher, cover_image FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='col-md-4 mb-4'>";
        echo "<div class='card'>";
        echo "<img src='" . $row["cover_image"] . "' class='card-img-top' alt='" . $row["title"] . "'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row["title"] . "</h5>";
        echo "<p class='card-text'>Автор: " . $row["author"] . "</p>";
        echo "<p class='card-text'>Год издания: " . $row["year"] . "</p>";
        echo "<p class='card-text'>ISBN: " . $row["isbn"] . "</p>";
        echo "<p class='card-text'>Издательство: " . $row["publisher"] . "</p>";
        echo "<a href='edit_book.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Редактировать</a>";
        echo "<a href='delete_book.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Удалить</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>Нет книг для отображения.</p>";
}

$conn->close();
?>
