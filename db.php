<?php
$servername = "localhost";
$username = "root";  // Ваше имя пользователя MySQL
$password = "";      // Ваш пароль MySQL
$dbname = "learning_platform";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
