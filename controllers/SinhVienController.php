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
        $sinhVien->Hinh = $_POST['Hinh'];
        $sinhVien->MaNganh = $_POST['MaNganh'];
        if ($sinhVien->create()) {
            header("Location: ?page=sinhvien&action=index");
        }
    }
    include "views/sinhvien/create.php";
} elseif ($action == "edit") {
    $maSV = $_GET['MaSV'] ?? null;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sinhVien->HoTen = $_POST['HoTen'];
        $sinhVien->GioiTinh = $_POST['GioiTinh'];
        $sinhVien->NgaySinh = $_POST['NgaySinh'];
        $sinhVien->Hinh = $_POST['Hinh'];
        $sinhVien->MaNganh = $_POST['MaNganh'];
        
        if ($sinhVien->update($_POST['MaSV'])) {
            header("Location: ?page=sinhvien&action=index");
        }
    }
    
    $sv = $sinhVien->getById($maSV);
    include "views/sinhvien/edit.php";
} elseif ($action == "delete") {
    $maSV = $_GET['MaSV'] ?? null;
    
    if ($maSV && $sinhVien->delete($maSV)) {
        header("Location: ?page=sinhvien&action=index");
    }
    
} elseif ($action == "detail") {
    $maSV = $_GET['MaSV'] ?? null;
    $sv = $sinhVien->getById($maSV);
    include "views/sinhvien/detail.php";
}
