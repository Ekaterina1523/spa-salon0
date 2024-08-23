<?php
require_once 'check_user.php';
require_once 'db_connect.php'; // Подключение к базе данных. Убедитесь, что переменная $conn определена в этом файле.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST['login']); // Очищаем от пробелов
    $password = trim($_POST['password']); // Очищаем от пробелов

    // Проверяем, не пустые ли логин и пароль
    if (empty($login) || empty($password)) {
        echo "Логин и пароль не должны быть пустыми.";
    } else {
        if (existsUser($login)) {
            echo "Пользователь с таким логином уже существует.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (login, password) VALUES (?, ?)");

            if ($stmt === false) {
                echo "Ошибка подготовки: " . $conn->error;
            } else {
                $stmt->bind_param("ss", $login, $hashed_password);

                if ($stmt->execute()) {
                    echo "Регистрация прошла успешно.";
                } else {
                    echo "Ошибка: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    }
}
$conn->close();
?>