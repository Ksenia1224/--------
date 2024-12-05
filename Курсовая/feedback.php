<?php
session_start();

// Убедимся, что сессионные переменные установлены
if (!isset($_SESSION['captcha_num1']) || !isset($_SESSION['captcha_num2'])) {
    $_SESSION['captcha_num1'] = rand(1, 10);
    $_SESSION['captcha_num2'] = rand(1, 10);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обратная связь</title>
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
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2em;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
            color: #4a2e19;
        }
        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0.5em;
            margin-top: 0.5em;
        }
        .form-control:focus {
            border-color: #4a2e19;
            box-shadow: 0 0 5px rgba(74, 46, 25, 0.5);
        }
        .btn-primary {
            background-color: #4a2e19;
            border: none;
            border-radius: 5px;
            padding: 0.75em 1.5em;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #965723;
            transform: scale(1.05);
        }
        .file-input-wrapper {
            position: relative;
            display: inline-block;
            background-color: #4a2e19;
            color: #fff;
            padding: 0.5em 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .file-input-wrapper:hover {
            background-color: #965723;
        }
        .file-input-wrapper input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
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
        .contact-info {
            text-align: left;
            margin-top: 20px;
        }
        .contact-info p {
            margin: 5px 0;
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
                                <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
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
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <main class="container my-5 flex-grow-1">
            <h2 class="text-center mb-4">Обратная связь</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-container">
                        <form id="feedbackForm" action="submit_feedback.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Имя:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Сообщение:</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">Вы также можете прикрепить файл:</label> <br>
                                <div class="file-input-wrapper">
                                    <span>Выбрать файл</span>
                                    <input type="file" id="file" name="file">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="captcha">Капча: <?php echo $_SESSION['captcha_num1'] . " + " . $_SESSION['captcha_num2']; ?> = </label>
                                <input type="number" class="form-control" id="captcha" name="captcha" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>
                        <div id="responseMessage" class="mt-3"></div>
                    </div>
                </div>
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
    <script>
        $(document).ready(function() {
            $('#feedbackForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: 'submit_feedback.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#responseMessage').html(response);
                        if (response.includes('успешно отправлено')) {
                            $('#feedbackForm')[0].reset();
                            $('#responseMessage').append('<p>Мы рассмотрим ваше предложение.</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + error);
                    }
                });
            });
        });
    </script>
</body>
</html>
