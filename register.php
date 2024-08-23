<?php
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $usersFile = 'users.json';
    $usersData = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

    if (array_key_exists($username, $usersData)) {
        $error = 'Пользователь с таким логином уже существует.';
    } else {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $usersData[$username] = $hashedPassword;

        file_put_contents($usersFile, json_encode($usersData));

        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Регистрация</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="register-form">
    <h2>Регистрация</h2>
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
                <input type="submit" value="Зарегистрироваться">
            </div>
        </div>
    </form>
    <p>Уже есть аккаунт? <a href="login.php">Войти</a>.</p>
</div>

</body>
</html>