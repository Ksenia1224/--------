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
            <h2 class="text-center mb-4">История выдачи книг</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Книга</th>
                        <th>Читатель</th>
                        <th>Дата выдачи</th>
                        <th>Срок возврата</th>
                        <th>Дата возврата</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
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

                    $sql = "SELECT loans.id, books.title, CONCAT(readers.first_name, ' ', readers.last_name) AS full_name, loans.loan_date, loans.due_date, loans.return_date, loans.status FROM loans JOIN books ON loans.book_id = books.id JOIN readers ON loans.user_id = readers.id";
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
                </tbody>
            </table>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Подключение пользовательских скриптов -->
    <script src="scripts.js"></script>
</body>
</html>
