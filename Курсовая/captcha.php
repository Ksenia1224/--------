<?php
session_start();

$num1 = rand(1, 9);
$num2 = rand(1, 9);
$captcha_answer = $num1 + $num2;

$_SESSION['captcha'] = $captcha_answer;
$_SESSION['captcha_question'] = "$num1 + $num2 = ?";

// Перенаправление на форму
header("Location: login.php");
exit();
?>
