<?php
// Include initialization file
require_once "init.php";

require_once "config/Database.php";

// Default route is home/index
$page = $_GET['page'] ?? 'sinhvien';
$action = $_GET['action'] ?? 'index';

// Create database connection
$db = (new Database())->getConnection();

// Define controller file path
$controllerFile = "controllers/" . ucfirst($page) . "Controller.php";

// Check if controller exists
if (file_exists($controllerFile)) {
    require_once $controllerFile;
} else {
    // 404 page not found
    echo "<div style='margin: 50px; text-align: center;'>";
    echo "<h1>404 - Trang không tồn tại</h1>";
    echo "<p>Không tìm thấy trang bạn yêu cầu.</p>";
    echo "<a href='?page=sinhvien&action=index' class='btn btn-primary'>Quay lại trang chủ</a>";
    echo "</div>";
}
?>
