<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}
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
            <h2 class="text-center mb-4">Список читателей</h2>
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addReaderModal">Добавить читателя</button>
            <div id="responseMessage" class="mt-3"></div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Номер читательского билета</th>
                        <th>Email</th>
                        <th>Действия</th>
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

                    $sql = "SELECT id, first_name, last_name, library_card_number, email FROM readers";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["first_name"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["last_name"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["library_card_number"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-warning btn-sm edit-reader' data-id='" . htmlspecialchars($row["id"]) . "'>Редактировать</button>";
                            echo "<button class='btn btn-danger btn-sm delete-reader' data-id='" . htmlspecialchars($row["id"]) . "'>Удалить</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Нет читателей для отображения.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </main>

        <!-- Модальное окно для добавления читателя -->
        <div class="modal fade" id="addReaderModal" tabindex="-1" role="dialog" aria-labelledby="addReaderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addReaderModalLabel">Добавить читателя</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addReaderForm">
                            <div class="form-group">
                                <label for="first_name">Имя:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Фамилия:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="library_card_number">Номер читательского билета:</label>
                                <input type="text" class="form-control" id="library_card_number" name="library_card_number" required>
                                <small id="libraryCardHelp" class="form-text text-muted">Номер читательского билета не должен совпадать с уже существующими номерами.</small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное окно для редактирования читателя -->
        <div class="modal fade" id="editReaderModal" tabindex="-1" role="dialog" aria-labelledby="editReaderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editReaderModalLabel">Редактировать читателя</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editReaderForm">
                            <input type="hidden" id="edit_reader_id" name="id">
                            <div class="form-group">
                                <label for="edit_first_name">Имя:</label>
                                <input type="text" class="form-control" id="edit_first_name" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_last_name">Фамилия:</label>
                                <input type="text" class="form-control" id="edit_last_name" name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_library_card_number">Номер читательского билета:</label>
                                <input type="text" class="form-control" id="edit_library_card_number" name="library_card_number" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_email">Email:</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Обновить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
    <script>
        $(document).ready(function() {
            // Добавление читателя
            $('#addReaderForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'add_reader.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#responseMessage').html(response);
                        if (response.includes('успешно зарегистрирован')) {
                            $('#addReaderModal').modal('hide');
                            location.reload();
                        }
                    }
                });
            });

            // Редактирование читателя
            $('.edit-reader').on('click', function() {
                var readerId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: 'get_reader.php',
                    data: { id: readerId },
                    success: function(response) {
                        var reader = JSON.parse(response);
                        $('#edit_reader_id').val(reader.id);
                        $('#edit_first_name').val(reader.first_name);
                        $('#edit_last_name').val(reader.last_name);
                        $('#edit_library_card_number').val(reader.library_card_number);
                        $('#edit_email').val(reader.email);
                        $('#editReaderModal').modal('show');
                    }
                });
            });

            // Отправка формы редактирования
            $('#editReaderForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'edit_reader.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#responseMessage').html(response);
                        if (response.includes('успешно обновлен')) {
                            $('#editReaderModal').modal('hide');
                            location.reload();
                        }
                    }
                });
            });

            // Удаление читателя
            $('.delete-reader').on('click', function() {
                var readerId = $(this).data('id');
                if (confirm('Вы уверены, что хотите удалить этого читателя?')) {
                    $.ajax({
                        type: 'GET',
                        url: 'delete_reader.php',
                        data: { id: readerId },
                        success: function(response) {
                            $('#responseMessage').html(response);
                            if (response.includes('успешно удален')) {
                                location.reload();
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
