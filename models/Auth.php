<?php
session_start();

class Auth {
    private $conn;
    private $table = "SinhVien";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($maSV) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE MaSV = ?");
        $stmt->execute([$maSV]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['loggedin'] = true;
            $_SESSION['MaSV'] = $user['MaSV'];
            $_SESSION['HoTen'] = $user['HoTen'];
            return true;
        }
        return false;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ?page=auth&action=login");
        exit;
    }

    public function isLoggedIn() {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }
}
