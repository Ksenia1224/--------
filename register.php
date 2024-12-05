<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="style.css" rel="stylesheet">
    <style>
        /* Стили для формы регистрации */
        body {
            font-family: 'Georgia', serif;
            background-color: #f4f4f4;
            background-image: url('vid2.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 650px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2em;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            max-width: 1000px; /* Увеличена ширина контейнера */
            width: 100%;
        }

        .form-title {
            text-align: center;
            font-size: 2em;
            color: #4a2e19; /* Темно-коричневый цвет для заголовка */
            margin-bottom: 1em;
            background-color: #fff; /* Белый фон для заголовка */
            padding: 0.5em 0;
            border-radius: 5px 5px 0 0; /* Скругленные углы сверху */
        }

        .form-group {
            margin-bottom: 1.5em;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5em;
            font-weight: bold;
            color: #4a2e19;
        }

        .form-group input {
            width: 100%;
            padding: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus {
            border-color: #4a2e19;
            box-shadow: 0 0 5px rgba(74, 46, 25, 0.5);
        }

        .btn {
            width: 100%;
            padding: 1em;
            background-color: #4a2e19;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #965723;
            transform: scale(1.05);
        }

        .text-center {
            text-align: center;
            margin-top: 1.5em;
        }

        .text-center a {
            color: #4a2e19;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .text-center a:hover {
            color: #965723;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Регистрация</h2>
            <form action="register_process.php" method="POST">
                <div class="form-group">
                    <label for="first_name">Имя:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Телефон:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Роль:</label>
                    <input type="text" id="role" name="role" required>
                </div>
                <div class="form-group">
                    <label for="library_card_number">Номер читательского билета:</label>
                    <input type="text" id="library_card_number" name="library_card_number" required>
                </div>
                <button type="submit" class="btn">Зарегистрироваться</button>
            </form>
            <p class="text-center mt-3">
                Уже есть аккаунт? <a href="login.php">Войдите</a>
            </p>
        </div>
    </div>
</body>
</html>
