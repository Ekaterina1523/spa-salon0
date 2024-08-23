<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $usersFile = 'users.json';
    $usersData = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

    if (array_key_exists($username, $usersData)) {

        if (password_verify($password, $usersData[$username])) {

            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            $error = 'Неправильное имя пользователя или пароль.';
        }
    } else {
        $error = 'Неправильное имя пользователя или пароль.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Вход</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-form">
    <h2>Вход</h2>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        <div class="container">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="Войти">
            </div>
        </div>
    </form>
    <p>Нет аккаунта? <a href="register.php">Регистрация</a>.</p>
</div>

</body>
</html>