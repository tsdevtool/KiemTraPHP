<?php
require_once "config/Database.php";
require_once "models/DangKy.php";
require_once "models/HocPhan.php";

session_start();
if (!isset($_SESSION['MaSV'])) {
    header("Location: ?page=auth&action=login");
    exit;
}

$db = (new Database())->getConnection();
$dangKy = new DangKy($db);
$hocPhan = new HocPhan($db);

$action = $_GET['action'] ?? 'index';
$maSV = $_SESSION['MaSV'] ?? null;

if ($action == "index") {
    $list = $hocPhan->getAll();
    include "views/dangky/index.php";
} elseif ($action == "register") {
    $maHP = $_GET['MaHP'] ?? null;
    
    if ($maHP && $dangKy->register($maSV, $maHP)) {
        // Registration successful
        echo "<script>alert('Đăng ký học phần thành công!'); window.location.href='?page=dangky&action=list';</script>";
    } else {
        // Registration failed
        echo "<script>alert('Lỗi khi đăng ký học phần! Số lượng có thể đã hết.'); window.location.href='?page=hocphan&action=index';</script>";
    }
}

if ($action == "list") {
    $list = $dangKy->getRegisteredCourses($maSV);
    include "views/dangky/list.php";
}

if ($action == "remove") {
    $maHP = $_GET['MaHP'] ?? null;
    
    if ($maHP) {
        // Increment the course capacity
        $stmt = $db->prepare("UPDATE HocPhan SET SoLuong = SoLuong + 1 WHERE MaHP = ?");
        $stmt->execute([$maHP]);
        
        // Remove from registration
        $stmt = $db->prepare("DELETE FROM ChiTietDangKy WHERE MaHP = ? AND MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?)");
        $stmt->execute([$maHP, $maSV]);
        
        header("Location: ?page=dangky&action=list");
    }
}

if ($action == "clear") {
    // Get all registered courses to restore capacity
    $registeredCourses = $dangKy->getRegisteredCourses($maSV);
    foreach ($registeredCourses as $course) {
        $stmt = $db->prepare("UPDATE HocPhan SET SoLuong = SoLuong + 1 WHERE MaHP = ?");
        $stmt->execute([$course['MaHP']]);
    }
    
    // Delete all registrations
    $stmt = $db->prepare("DELETE FROM ChiTietDangKy WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?)");
    $stmt->execute([$maSV]);
    
    $stmt = $db->prepare("DELETE FROM DangKy WHERE MaSV = ?");
    $stmt->execute([$maSV]);
    
    header("Location: ?page=dangky&action=list");
}