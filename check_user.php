<?php

$servername = "hostname";
$username = "db_username";
$password = "db_password";
$dbname = "database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];

    if (existsUser($login)) {
        echo json_encode(["exists" => true]);
    } else {
        echo json_encode(["exists" => false]);
    }
}

function existsUser($login) {
    global $conn;
    $stmt = $conn->prepare("SELECT id FROM users WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
?>

<?php
function checkPassword($login, $password) {
    global $pdo;

    $stmt = $pdo->prepare('SELECT password_hash FROM users WHERE login = :login');
    $stmt->bindParam(':login', $login);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        if (password_verify($password, $result['password_hash'])) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

$login = $_POST['login'];
$password = $_POST['password'];
if (checkPassword($login, $password)) {
    echo 'Пароль верен!';
} else {
    echo 'Неверный логин или пароль.';
}
?>