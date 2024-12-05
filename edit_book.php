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

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$sql = "SELECT * FROM books WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Книга не найдена.";
    exit;
}

$conn->close();
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас</title>
    <!-- Подключение Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Подключение пользовательских стилей -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <header class="bg-dark text-white py-3">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="logo-container">
                    <a href="index.php">
                        <img src="logo.jpg" alt="Логотип" class="logo">
                    </a>
                </div>
                <h1 class="mb-0">БиблиоМир</h1>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="books.php">Книги</a>
                </li>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="readers.php">Читатели</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loans.php">Выданные книги</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="feedback.php">Обратная связь</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">О нас</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Выход</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Вход</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Регистрация</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

            </div>
        </header>

        <main class="container my-5 flex-grow-1">
            <h2 class="text-center mb-4">Редактирование книги</h2>

            <!-- Форма для редактирования книги -->
            <form action="update_book.php" method="POST" enctype="multipart/form-data" class="mb-4">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                <input type="hidden" name="current_cover_image" value="<?php echo htmlspecialchars($row['cover_image']); ?>">
                <input type="hidden" name="current_book_file" value="<?php echo htmlspecialchars($row['book_file']); ?>">
                <div class="form-group">
                    <label for="title">Название:</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="author">Автор:</label>
                    <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($row['author']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="seria">Серия:</label>
                    <input type="text" class="form-control" id="seria" name="seria" value="<?php echo htmlspecialchars($row['seria']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="genre">Жанр:</label>
                    <input type="text" class="form-control" id="genre" name="genre" value="<?php echo htmlspecialchars($row['genre']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="year">Год издания:</label>
                    <input type="number" class="form-control" id="year" name="year" value="<?php echo htmlspecialchars($row['year']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo htmlspecialchars($row['isbn']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="publisher">Издательство:</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo htmlspecialchars($row['publisher']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Описание:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="cover_image">Обложка:</label>
                    <input type="file" class="form-control-file" id="cover_image" name="cover_image" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="book_file">Файл книги:</label>
                    <input type="file" class="form-control-file" id="book_file" name="book_file" accept=".fb2,.txt,.epub,.rtf">
                </div>
                <button type="submit" class="btn btn-primary">Обновить книгу</button>
            </form>
        </main>

        <footer class="bg-dark text-white text-center py-3">
            <div class="footer-links">
                <a href="index.php">Главная</a>
                <a href="about.php">О нас</a>
                <a href="books.php">Книги</a>
                <a href="feedback.php">Обратная связь</a>
            </div>
            <div class="contact-info">
                <p>Адрес: ул. Примерная, 123, Краснодар, Россия</p>
                <p>Телефон: +7 (861) 123-45-67</p>
                <p>Email: info@bibliomir.ru</p>
            </div>
            <p>&copy; 2024 БиблиоМир. Все права защищены.</p>
        </footer>
    </div>

    <!-- Подключение Bootstrap JS и зависимостей -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Подключение пользовательских скриптов -->
    <script src="scripts.js"></script>
</body>
</html>
