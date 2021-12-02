<?php

if (isset($_POST['logout'])) {
    if (isset($_COOKIE['username'])) {
        unset($_COOKIE['username']);
        setcookie('username', null, -1);
        unset($_SESSION['is_admin']);
        session_destroy();
    }
}

if (!isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit();
}
