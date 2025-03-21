<?php
require_once "config/Database.php";
require_once "models/SinhVien.php";

$db = (new Database())->getConnection();
$sinhVien = new SinhVien($db);

$action = $_GET['action'] ?? 'index';

if ($action == "index") {
    $list = $sinhVien->getAll();
    include "views/sinhvien/index.php";
} elseif ($action == "create") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sinhVien->MaSV = $_POST['MaSV'];
        $sinhVien->HoTen = $_POST['HoTen'];
        $sinhVien->GioiTinh = $_POST['GioiTinh'];
        $sinhVien->NgaySinh = $_POST['NgaySinh'];
        $sinhVien->MaNganh = $_POST['MaNganh'];
        
        // Xử lý upload hình ảnh
        $sinhVien->Hinh = 'public/storage/images/no-avatar.png'; // Mặc định
        
        if(isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['hinhAnh']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if(in_array($ext, $allowed)) {
                // Tạo tên file duy nhất để tránh trùng lặp
                $newFilename = uniqid() . '.' . $ext;
                $uploadPath = 'public/storage/images/' . $newFilename;
                
                if(move_uploaded_file($_FILES['hinhAnh']['tmp_name'], $uploadPath)) {
                    $sinhVien->Hinh = $uploadPath;
                }
            }
        }
        
        if ($sinhVien->create()) {
            header("Location: ?page=sinhvien&action=index");
            exit;
        }
    }
    include "views/sinhvien/create.php";
} elseif ($action == "edit") {
    $maSV = $_GET['MaSV'] ?? null;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sinhVien->HoTen = $_POST['HoTen'];
        $sinhVien->GioiTinh = $_POST['GioiTinh'];
        $sinhVien->NgaySinh = $_POST['NgaySinh'];
        $sinhVien->MaNganh = $_POST['MaNganh'];
        
        // Lấy thông tin sinh viên hiện tại
        $currentSV = $sinhVien->getById($_POST['MaSV']);
        $sinhVien->Hinh = $currentSV['Hinh']; // Giữ nguyên hình ảnh cũ
        
        // Kiểm tra nếu người dùng muốn xóa hình
        if(isset($_POST['xoaHinh']) && $_POST['xoaHinh'] == 1) {
            // Nếu không phải hình mặc định, xóa file
            if($currentSV['Hinh'] !== 'public/storage/images/no-avatar.png' && file_exists($currentSV['Hinh'])) {
                unlink($currentSV['Hinh']);
            }
            $sinhVien->Hinh = 'public/storage/images/no-avatar.png';
        }
        // Kiểm tra nếu có upload hình mới
        elseif(isset($_FILES['hinhAnh']) && $_FILES['hinhAnh']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['hinhAnh']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if(in_array($ext, $allowed)) {
                // Tạo tên file duy nhất
                $newFilename = uniqid() . '.' . $ext;
                $uploadPath = 'public/storage/images/' . $newFilename;
                
                if(move_uploaded_file($_FILES['hinhAnh']['tmp_name'], $uploadPath)) {
                    // Xóa hình cũ nếu không phải hình mặc định
                    if($currentSV['Hinh'] !== 'public/storage/images/no-avatar.png' && file_exists($currentSV['Hinh'])) {
                        unlink($currentSV['Hinh']);
                    }
                    $sinhVien->Hinh = $uploadPath;
                }
            }
        }
        
        if ($sinhVien->update($_POST['MaSV'])) {
            header("Location: ?page=sinhvien&action=index");
            exit;
        }
    }
    
    $sv = $sinhVien->getById($maSV);
    include "views/sinhvien/edit.php";
} elseif ($action == "delete") {
    $maSV = $_GET['MaSV'] ?? null;
    
    if ($maSV) {
        // Lấy thông tin sinh viên để xóa hình ảnh nếu cần
        $sv = $sinhVien->getById($maSV);
        
        $result = $sinhVien->delete($maSV);
        if ($result) {
            // Nếu xóa sinh viên thành công, xóa hình ảnh nếu không phải hình mặc định
            if($sv && $sv['Hinh'] !== 'public/storage/images/no-avatar.png' && file_exists($sv['Hinh'])) {
                unlink($sv['Hinh']);
            }
            header("Location: ?page=sinhvien&action=index");
            exit;
        } else {
            // Redirect với thông báo lỗi nếu xóa không thành công
            $error_message = "Không thể xóa sinh viên. Vui lòng kiểm tra xem sinh viên này có dữ liệu liên quan không.";
            header("Location: ?page=sinhvien&action=index&error=" . urlencode($error_message));
            exit;
        }
    } else {
        header("Location: ?page=sinhvien&action=index");
        exit;
    }
} elseif ($action == "detail") {
    $maSV = $_GET['MaSV'] ?? null;
    $sv = $sinhVien->getById($maSV);
    include "views/sinhvien/detail.php";
}
