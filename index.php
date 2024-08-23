<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Спа-салон</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<footer>
    <p>&copy; 2023 Spa-Salon</p>
</footer>

</body>
</html>