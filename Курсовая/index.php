<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
require 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
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
        header {
            background-color: #4a2e19;
            color: #fff;
            padding: 1em 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 1em;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        nav ul li a:hover {
            color: #965723;
        }
        main {
            padding: 2em;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .intro {
            text-align: center;
            margin-bottom: 2em;
        }
        .intro h2 {
            font-size: 2em;
            color: #4a2e19;
        }
        .intro p {
            font-size: 1.2em;
            color: #555;
        }
        .features {
            text-align: center;
        }
        .features h2 {
            font-size: 2em;
            color: #4a2e19;
        }
        .feature-item {
            margin: 1em;
            text-align: center;
        }
        .feature-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-item img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .feature-item p {
            font-size: 1.1em;
            color: #555;
            margin-top: 0.5em;
        }
        footer {
            background-color: #4a2e19;
            color: #fff;
            text-align: center;
            padding: 1em 0;
            font-size: 0.9em;
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
        .contact-info {
            text-align: center;
            margin-top: 20px;
        }
        .contact-info p {
            margin: 5px 0;
            text-align: left;
            display: inline-block;
            margin-left: 15px;
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
            <section class="intro text-center">
                <h2>Добро пожаловать в систему учета выдачи книг в библиотеке "БиблиоМир"</h2>
                <p>Эта система позволяет управлять книгами, читателями и записями о выдаче книг. Вы можете добавлять, редактировать и удалять записи, а также оставлять обратную связь.</p>
                <img src="bibl.jpg" alt="Библиотека" class="img-fluid rounded mx-auto d-block my-4" style="max-width: 500px;">
            </section>

            <section class="features text-center my-5">
                <h2>Основные функции</h2>
                <div class="d-flex justify-content-center flex-wrap">
                    <div class="feature-item mx-3">
                        <a href="books.php">
                            <img src="book.jpg" alt="Книги" class="img-fluid rounded mx-auto d-block my-2" style="max-width: 100px;">
                        </a>
                        <p>Управление книгами</p>
                    </div>
                    <div class="feature-item mx-3">
                        <a href="readers.php">
                            <img src="readers.jpg" alt="Читатели" class="img-fluid rounded mx-auto d-block my-2" style="max-width: 100px;">
                        </a>
                        <p>Управление читателями</p>
                    </div>
                    <div class="feature-item mx-3">
                        <a href="loans.php">
                            <img src="issued_books.jpg" alt="Выданные книги" class="img-fluid rounded mx-auto d-block my-2" style="max-width: 100px;">
                        </a>
                        <p>Учет выданных книг</p>
                    </div>
                    <div class="feature-item mx-3">
                        <a href="feedback.php">
                            <img src="feedback.jpg" alt="Обратная связь" class="img-fluid rounded mx-auto d-block my-2" style="max-width: 100px;">
                        </a>
                        <p>Обратная связь</p>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-dark text-white py-3">
            <div class="container">
                <div class="footer-links text-center mb-3">
                    <a href="index.php">Главная</a>
                    <a href="about.php">О нас</a>
                    <a href="books.php">Книги</a>
                    <a href="feedback.php">Обратная связь</a>
                </div>
                <div class="contact-info text-left">
                    <p>Адрес: ул. Примерная, 123, Краснодар, Россия</p>
                    <p>Телефон: +7 (861) 123-45-67</p>
                    <p>Email: info@bibliomir.ru</p>
                </div>
                <p class="text-center mt-3">&copy; 2024 БиблиоМир. Все права защищены.</p>
            </div>
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
