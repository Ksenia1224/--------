<?php
session_start();
require 'config.php';
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
        .slide {
            display: none;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .slide.active {
            display: block;
            opacity: 1;
        }
        .slideshow {
            position: relative;
        }
        .slideshow .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
        }
        .slideshow .arrow.left {
            left: 10px;
        }
        .slideshow .arrow.right {
            right: 10px;
        }
        .contact-info {
            margin-top: 20px;
            text-align: left;
        }
        .contact-info p {
            margin: 5px 0;
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
            <section class="section-header">
                <h2>О нас</h2>
            </section>
            <section class="about text-center">
                <p>Добро пожаловать в библиотеку "БиблиоМир"! Мы рады приветствовать вас в нашем уютном и современном пространстве, где книги и знания становятся доступными для всех.</p>
                <p>Наша библиотека была основана с целью создания комфортной среды для чтения и обучения. Мы предлагаем широкий ассортимент книг различных жанров, от классики до современной литературы, а также образовательные и научные издания.</p>
                <p>В "БиблиоМир" вы найдете не только книги, но и разнообразные мероприятия, такие как литературные вечера, встречи с авторами и книжные клубы. Мы стремимся сделать чтение доступным и интересным для всех возрастов.</p>
                <div class="slideshow">
                    <button class="arrow left" onclick="prevSlide()">&#10094;</button>
                    <div class="slide active">
                        <img src="vid1.jpg" alt="Вид БиблиоМир" class="img-fluid rounded mx-auto d-block my-4" style="max-width: 500px;">
                        <p>Вид БиблиоМир</p>
                    </div>
                    <div class="slide">
                        <img src="vid2.jpg" alt="Вид БиблиоМир" class="img-fluid rounded mx-auto d-block my-4" style="max-width: 500px;">
                        <p>Вид БиблиоМир</p>
                    </div>
                    <div class="slide">
                        <img src="vid3.jpg" alt="Жанры" class="img-fluid rounded mx-auto d-block my-4" style="max-width: 500px;">
                        <p>Встречи с авторами</p>
                    </div>
                    <div class="slide">
                        <img src="vid4.jpg" alt="Посиделки и литературные вечера" class="img-fluid rounded mx-auto d-block my-4" style="max-width: 500px;">
                        <p>Посиделки и литературные вечера</p>
                    </div>
                    <button class="arrow right" onclick="nextSlide()">&#10095;</button>
                </div>
            </section>

            <section class="section-header">
                <h2>Наше местоположение</h2>
            </section>
            <section class="map my-5">
                <div id="map" style="width: 100%; height: 400px;"></div>
            </section>

            <section class="section-header">
                <h2>Контактная информация</h2>
            </section>
            <section class="contact-info">
                <p>Адрес: ул. Примерная, 123, Краснодар, Россия</p>
                <p>Телефон: +7 (861) 123-45-67</p>
                <p>Email: info@bibliomir.ru</p>
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
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script type="text/javascript">
        ymaps.ready(init);
        function init(){
            var myMap = new ymaps.Map("map", {
                center: [45.035472, 38.975313],
                zoom: 12
            });

            var myPlacemark = new ymaps.Placemark([45.035472, 38.975313], {
                balloonContent: 'Библиотека "БиблиоМир"'
            });

            myMap.geoObjects.add(myPlacemark);
        }

        // Слайд-шоу
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        setInterval(nextSlide, 5000);

        // Проверка загрузки изображений
        slides.forEach(slide => {
            const img = slide.querySelector('img');
            img.onerror = function() {
                console.error(`Ошибка загрузки изображения: ${img.src}`);
            };
        });
    </script>
</body>
</html>
