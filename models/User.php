<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($name, $email, $password, $is_admin = 0) {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, is_admin, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
        return $stmt->execute([$name, $email, password_hash($password, PASSWORD_BCRYPT), $is_admin]);
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['is_admin'];
            return true;
        }
        return false;
    }
}
?>