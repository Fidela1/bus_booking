<?php
session_start();

$role = $_SESSION['role'] ?? '';

if ($role == "admin") {
    header("Location: /app/views/admin/dashboard.php");
} elseif ($role == "user") {
    header("Location: /app/views/user/dashboard.php");
} else {
    header("Location: /auth/login.php");
}
?>
