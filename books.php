<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление книгами</title>
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
            <section class="section-header">
                <h2>Управление книгами</h2>
            </section>
            <form action="add_book.php" method="POST" enctype="multipart/form-data" class="mb-4">
                <div class="form-group">
                    <label for="title">Название:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="author">Автор:</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label for="seria">Серия:</label>
                    <input type="text" class="form-control" id="seria" name="seria" required>
                </div>
                <div class="form-group">
                    <label for="genre">Жанр:</label>
                    <input type="text" class="form-control" id="genre" name="genre" required>
                </div>
                <div class="form-group">
                    <label for="year">Год издания:</label>
                    <input type="number" class="form-control" id="year" name="year" required>
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" required>
                </div>
                <div class="form-group">
                    <label for="publisher">Издательство:</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" required>
                </div>
                <div class="form-group">
                    <label for="description">Описание:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="cover_image">Обложка:</label>
                    <input type="file" class="form-control-file" id="cover_image" name="cover_image" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="book_file">Файл книги:</label>
                    <input type="file" class="form-control-file" id="book_file" name="book_file" accept=".fb2,.txt,.epub,.rtf">
                </div>
                <button type="submit" class="btn btn-primary">Добавить книгу</button>
            </form>

            <section class="section-header">
                <h2>Популярные книги</h2>
            </section>
            <div class="row">
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
                        echo "<div class='card h-100'>";
                        echo "<a href='book_details.php?id=" . htmlspecialchars($row["id"]) . "'>";
                        echo "<img src='" . htmlspecialchars($row["cover_image"]) . "' class='card-img-top' alt='" . htmlspecialchars($row["title"]) . "' style='height: 300px; object-fit: cover;'>";
                        echo "</a>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . htmlspecialchars($row["title"]) . "</h5>";
                        echo "<p class='card-text'>Автор: " . htmlspecialchars($row["author"]) . "</p>";
                        echo "<p class='card-text'>Год издания: " . htmlspecialchars($row["year"]) . "</p>";
                        echo "<p class='card-text'>ISBN: " . htmlspecialchars($row["isbn"]) . "</p>";
                        echo "<p class='card-text'>Издательство: " . htmlspecialchars($row["publisher"]) . "</p>";
                        echo "<a href='edit_book.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-warning btn-sm'>Редактировать</a>";
                        echo "<a href='delete_book.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-danger btn-sm'>Удалить</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Нет книг для отображения.</p>";
                }

                $conn->close();
                ?>
            </div>
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
                    <p>Адрес: ул. Примерная, 123, Краснодар, Россия</p> <br>
            
                    <p>Телефон: +7 (861) 123-45-67</p> <br>
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
