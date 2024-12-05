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

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас</title>
    <!-- Подключение Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Подключение пользовательских стилей -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f4f4f4;
            background-image: url('vid2.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
        }
        .footer-links {
            margin-bottom: 20px;
        }
        .footer-links a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
        .section-header {
            background-color: #4a2e19;
            color: #fff;
            padding: 1em 0;
            text-align: center;
            margin-bottom: 2em;
        }
        .section-header h2 {
            margin: 0;
            font-size: 2.5em;
        }
        .btn-custom {
            background-color: #4a2e19;
            border-color: #4a2e19;
            color: #fff;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #965723;
            border-color: #965723;
        }
        .book-cover {
            width: 100%;
            height: auto;
            max-width: 300px; /* Установите максимальную ширину для обложек */
            max-height: 400px; /* Установите максимальную высоту для обложек */
            object-fit: contain; /* Сохраняем пропорции изображения */
        }
    </style>
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
            <!-- Кнопка "Вернуться назад" -->
            <button class="btn btn-custom mb-3" onclick="goBack()">Вернуться назад</button>

            <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo htmlspecialchars($row['cover_image']); ?>" class="img-fluid rounded book-cover" alt="<?php echo htmlspecialchars($row['title']); ?>">
                </div>
                <div class="col-md-8">
                    <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                    <p><strong>Автор:</strong> <?php echo htmlspecialchars($row['author']); ?></p>
                    <p><strong>Серия:</strong> <?php echo htmlspecialchars($row['seria']); ?></p>
                    <p><strong>Жанр:</strong> <?php echo htmlspecialchars($row['genre']); ?></p>
                    <p><strong>Год издания:</strong> <?php echo htmlspecialchars($row['year']); ?></p>
                    <p><strong>ISBN:</strong> <?php echo htmlspecialchars($row['isbn']); ?></p>
                    <p><strong>Издательство:</strong> <?php echo htmlspecialchars($row['publisher']); ?></p>
                    <a href="<?php echo htmlspecialchars($row['book_file']); ?>" class="btn btn-custom">Читать онлайн</a>
                    <a href="<?php echo htmlspecialchars($row['book_file']); ?>" class="btn btn-custom" download>Скачать</a>
                </div>
            </div>
            <div class="mt-4">
                <h3>О книге "<?php echo htmlspecialchars($row['title']); ?>"</h3>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
            </div>
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
    <!-- JavaScript для кнопки "Вернуться назад" -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
