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

$id = intval($_POST["id"]);
$title = strip_tags(trim($_POST["title"]));
$author = strip_tags(trim($_POST["author"]));
$seria = strip_tags(trim($_POST["seria"]));
$genre = strip_tags(trim($_POST["genre"]));
$year = intval($_POST["year"]);
$isbn = trim($_POST["isbn"]);
$publisher = strip_tags(trim($_POST["publisher"]));
$description = strip_tags(trim($_POST["description"]));

// Проверка и создание директории для загрузки файлов
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

// Обработка загрузки изображения
$cover_image = $_POST["current_cover_image"];
if ($_FILES["cover_image"]["name"]) {
    $target_file = $target_dir . basename($_FILES["cover_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Проверка на допустимые форматы изображений
    $allowed_types = array("jpg", "jpeg", "png", "gif");
    if (in_array($imageFileType, $allowed_types)) {
        if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file)) {
            $cover_image = $target_file;
        }
    }
}

// Обработка загрузки файла книги
$book_file = $_POST["current_book_file"];
if ($_FILES["book_file"]["name"]) {
    $book_file_path = $target_dir . basename($_FILES["book_file"]["name"]);
    if (move_uploaded_file($_FILES["book_file"]["tmp_name"], $book_file_path)) {
        $book_file = $book_file_path;
    }
}

$sql = "UPDATE books SET title='$title', author='$author', seria='$seria', genre='$genre', year=$year, isbn='$isbn', publisher='$publisher', cover_image='$cover_image', book_file='$book_file', description='$description' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: books.php");
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
