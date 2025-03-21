<?php
require_once "config/Database.php";
require_once "models/Auth.php";

$db = (new Database())->getConnection();
$auth = new Auth($db);

$action = $_GET['action'] ?? 'login';

if ($action == "login") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $maSV = $_POST['MaSV'];
        if ($auth->login($maSV)) {
            header("Location: ?page=hocphan&action=index");
            exit;
        } else {
            $error = "Mã sinh viên không hợp lệ!";
        }
    }
    include "views/auth/login.php";
} elseif ($action == "logout") {
    $auth->logout();
} 