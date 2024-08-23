<?php
session_start();

function getCurrentUser() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}
?>