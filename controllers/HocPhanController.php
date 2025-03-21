<?php
// No need to start session here as it's done in init.php which is included by router.php

require_once "config/Database.php";
require_once "models/HocPhan.php";
require_once "models/DangKy.php";

$db = (new Database())->getConnection();
$hocPhan = new HocPhan($db);
$dangky = new DangKy($db);

$action = $_GET['action'] ?? 'index';

if ($action == "index") {
    $listHP = $hocPhan->getAll();
    include "views/hocphan/index.php";
} elseif ($action == "create") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hocPhan->MaHP = $_POST['MaHP'];
        $hocPhan->TenHP = $_POST['TenHP'];
        $hocPhan->SoTinChi = $_POST['SoTinChi'];
        $hocPhan->SoLuong = $_POST['SoLuong'];
        if ($hocPhan->create()) {
            header("Location: ?page=hocphan&action=index");
        }
    }
    include "views/hocphan/create.php";
} elseif ($action == "edit") {
    $maHP = $_GET['MaHP'] ?? null;
    
    if (!$maHP) {
        $_SESSION['error'] = "Không tìm thấy mã học phần!";
        header("Location: ?page=hocphan&action=index");
        exit;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hocPhan->TenHP = $_POST['TenHP'];
        $hocPhan->SoTinChi = $_POST['SoTinChi'];
        $hocPhan->SoLuong = $_POST['SoLuong'];
        
        if ($hocPhan->update($_POST['MaHP'])) {
            $_SESSION['success'] = "Cập nhật học phần thành công!";
            header("Location: ?page=hocphan&action=index");
            exit;
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật học phần!";
        }
    }
    
    $hp = $hocPhan->getById($maHP);
    
    if (!$hp) {
        $_SESSION['error'] = "Không tìm thấy học phần với mã {$maHP}!";
        header("Location: ?page=hocphan&action=index");
        exit;
    }
    
    include "views/hocphan/edit.php";
} elseif ($action == "delete") {
    $maHP = $_GET['MaHP'] ?? null;
    
    if (!$maHP) {
        $_SESSION['error'] = "Không tìm thấy mã học phần để xóa!";
        header("Location: ?page=hocphan&action=index");
        exit;
    }
    
    try {
        // Kiểm tra xem học phần có đăng ký không
        $stmt = $db->prepare("
            SELECT COUNT(*) FROM ChiTietDangKy 
            WHERE MaHP = ?
        ");
        $stmt->execute([$maHP]);
        $hasRegistrations = $stmt->fetchColumn() > 0;
        
        if ($hasRegistrations) {
            // Xóa các đăng ký trước
            $db->beginTransaction();
            
            // Xóa các chi tiết đăng ký
            $stmt = $db->prepare("DELETE FROM ChiTietDangKy WHERE MaHP = ?");
            $stmt->execute([$maHP]);
            
            // Sau đó xóa học phần
            if ($hocPhan->delete($maHP)) {
                $db->commit();
                $_SESSION['success'] = "Xóa học phần thành công!";
            } else {
                $db->rollBack();
                $_SESSION['error'] = "Không thể xóa học phần!";
            }
        } else {
            // Không có đăng ký, xóa trực tiếp
            if ($hocPhan->delete($maHP)) {
                $_SESSION['success'] = "Xóa học phần thành công!";
            } else {
                $_SESSION['error'] = "Không thể xóa học phần!";
            }
        }
    } catch (PDOException $e) {
        // Ghi log lỗi thực tế
        error_log($e->getMessage());
        $_SESSION['error'] = "Lỗi khi xóa học phần: Học phần này có thể đang được sử dụng!";
    }
    
    header("Location: ?page=hocphan&action=index");
    exit;
}
