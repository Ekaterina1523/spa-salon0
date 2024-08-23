<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Личный Кабинет</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<p>Это ваш личный кабинет.</p>
<a href="logout.php">Выйти</a>

</body>
</html>