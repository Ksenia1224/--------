<?php
require 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Учёт выдачи и возврата книг</title>
    <!-- Подключение Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Подключение DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
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
            <h2 class="text-center mb-4">Учёт выдачи и возврата книг</h2>
            <div id="responseMessage" class="mt-3"></div>

            <!-- Поиск -->
            <div class="search-bar">
                <form id="searchForm">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Введите текст для поиска">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Искать</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Форма для выдачи книги -->
            <form id="issueBookForm" class="mb-4">
                <h3>Выдача книги</h3>
                <div class="form-group">
                    <label for="book_id">Книга:</label>
                    <select class="form-control" id="book_id" name="book_id" required>
                        <option value="">Выберите книгу</option>
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

                        $sql = "SELECT id, title FROM books";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["id"] . "'>" . $row["title"] . "</option>";
                            }
                        }

                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="readers_id">Читатель:</label>
                    <select class="form-control" id="readers_id" name="readers_id" required>
                        <option value="">Выберите читателя</option>
                        <?php
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Проверяем соединение
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM readers";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["id"] . "'>" . $row["full_name"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Нет читателей</option>";
                        }

                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="due_date">Срок возврата:</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" required min="<?php echo date('Y-m-d', strtotime('+2 days')); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Выдать книгу</button>
            </form>

            <!-- Таблица выданных книг -->
            <h3>Выданные книги</h3>
            <table class="table table-bordered" id="loansTable">
                <thead>
                    <tr>
                        <th>Книга</th>
                        <th>Читатель</th>
                        <th>Дата выдачи</th>
                        <th>Срок возврата</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Проверяем соединение
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT loans.id, books.title, CONCAT(readers.first_name, ' ', readers.last_name) AS full_name, DATE(loans.loan_date) AS loan_date, DATE(loans.due_date) AS due_date, loans.status FROM loans JOIN books ON loans.book_id = books.id JOIN readers ON loans.readers_id = readers.id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $statusClass = '';
                            if ($row["status"] == "Просрочена" || $row["status"] == "Утеряна") {
                                $statusClass = 'text-danger';
                            } elseif ($row["status"] == "Возвращена") {
                                $statusClass = 'text-success';
                            }
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["full_name"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["loan_date"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["due_date"]) . "</td>";
                            echo "<td class='$statusClass'>" . htmlspecialchars($row["status"]) . "</td>";
                            echo "<td>
                                    <select class='form-control status-select' data-loan-id='" . $row["id"] . "'>
                                        <option value='Выдана' " . ($row["status"] == 'Выдана' ? 'selected' : '') . ">Выдана</option>
                                        <option value='Просрочена' " . ($row["status"] == 'Просрочена' ? 'selected' : '') . ">Просрочена</option>
                                        <option value='Утеряна' " . ($row["status"] == 'Утеряна' ? 'selected' : '') . ">Утеряна</option>
                                        <option value='Возвращена' " . ($row["status"] == 'Возвращена' ? 'selected' : '') . ">Возвращена</option>
                                    </select>
                                  </td>";
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
            <p>&copy; 2024 БиблиоМир. Все права защищены.</p>
        </footer>
    </div>

    <!-- Подключение Bootstrap JS и зависимостей -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Подключение DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!-- Подключение пользовательских скриптов -->
    <script>
      $(document).ready(function() {
    // Инициализация DataTables
    $('#loansTable').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/Russian.json"
        }
    });

    // Выдача книги
    $('#issueBookForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'issue_book.php',
            data: $(this).serialize(),
            success: function(response) {
                $('#responseMessage').html(response);
                if (response.includes('успешно выдана')) {
                    $('#issueBookForm')[0].reset();
                    // Обновление таблицы после добавления записи
                    $.ajax({
                        type: 'POST',
                        url: 'load_loans.php',
                        success: function(response) {
                            $('#loansTable tbody').html(response);
                            // Переинициализация DataTables после обновления данных
                            $('#loansTable').DataTable().clear().destroy();
                            $('#loansTable').DataTable({
                                "language": {
                                    "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/Russian.json"
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Ошибка при загрузке данных:', error);
                            $('#responseMessage').html('<div class="alert alert-danger" role="alert">Ошибка при загрузке данных.</div>');
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Ошибка при выдаче книги:', error);
                $('#responseMessage').html('<div class="alert alert-danger" role="alert">Ошибка при выдаче книги.</div>');
            }
        });
    });

    // Поиск данных
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        var search = $('#search').val();
        $.ajax({
            type: 'POST',
            url: 'search_loans.php',
            data: { search: search },
            success: function(response) {
                $('#loansTable tbody').html(response);
                // Переинициализация DataTables после обновления данных
                $('#loansTable').DataTable().clear().destroy();
                $('#loansTable').DataTable({
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.11.5/i18n/Russian.json"
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Ошибка при поиске данных:', error);
                $('#responseMessage').html('<div class="alert alert-danger" role="alert">Ошибка при поиске данных.</div>');
            }
        });
    });

    // Изменение статуса
    $(document).on('change', '.status-select', function() {
        var loanId = $(this).data('loan-id');
        var newStatus = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'update_status.php',
            data: { loanId: loanId, newStatus: newStatus },
            success: function(response) {
                $('#responseMessage').html(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Ошибка при изменении статуса:', error);
                $('#responseMessage').html('<div class="alert alert-danger" role="alert">Ошибка при изменении статуса.</div>');
            }
        });
    });
});
</script>
</body>
    </html>