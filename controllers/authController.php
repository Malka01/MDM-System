<?php
session_start();
require_once '../config/db.php'; // DB connection

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Check user exists and password matches
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: ../views/dashboard.php"); // Redirect to dashboard
        exit;
    } else {
        $_SESSION['error'] = "Invalid email or password";
        header("Location: ../views/auth/login.php"); // Redirect back to login
        exit;
    }
}
