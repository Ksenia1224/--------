<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
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
            <section class="intro text-center">
                <h2>Добро пожаловать в систему учета выдачи книг в библиотеке "БиблиоМир"</h2>
                <p>Эта система позволяет управлять книгами, читателями и записями о выдаче книг. Вы можете добавлять, редактировать и удалять записи, а также оставлять обратную связь.</p>
                <img src="bibl.jpg" alt="Библиотека" class="img-fluid rounded mx-auto d-block my-4" style="max-width: 500px;">
            </section>

            <section class="features text-center my-5">
                <h2>Основные функции</h2>
                <div class="d-flex justify-content-center flex-wrap">
                    <div class="feature-item mx-3">
                        <a href="index.html">
                            <img src="book.jpg" alt="Книги" class="img-fluid rounded mx-auto d-block my-2" style="max-width: 100px;">
                        </a>
                        <p>Управление книгами</p>
                    </div>
                    <div class="feature-item mx-3">
                        <a href="readers.html">
                            <img src="readers.jpg" alt="Читатели" class="img-fluid rounded mx-auto d-block my-2" style="max-width: 100px;">
                        </a>
                        <p>Управление читателями</p>
                    </div>
                    <div class="feature-item mx-3">
                        <a href="issued_books.html">
                            <img src="issued_books.jpg" alt="Выданные книги" class="img-fluid rounded mx-auto d-block my-2" style="max-width: 100px;">
                        </a>
                        <p>Учет выданных книг</p>
                    </div>
                    <div class="feature-item mx-3">
                        <a href="feedback.html">
                            <img src="feedback.jpg" alt="Обратная связь" class="img-fluid rounded mx-auto d-block my-2" style="max-width: 100px;">
                        </a>
                        <p>Обратная связь</p>
                    </div>
                </div>
            </section>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
