<?php
require_once "config/Database.php";
require_once "models/HocPhan.php";

$db = (new Database())->getConnection();
$hocPhan = new HocPhan($db);

$action = $_GET['action'] ?? 'index';

if ($action == "index") {
    $list = $hocPhan->getAll();
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
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hocPhan->TenHP = $_POST['TenHP'];
        $hocPhan->SoTinChi = $_POST['SoTinChi'];
        $hocPhan->SoLuong = $_POST['SoLuong'];
        
        if ($hocPhan->update($_POST['MaHP'])) {
            header("Location: ?page=hocphan&action=index");
        }
    }
    
    $hp = $hocPhan->getById($maHP);
    include "views/hocphan/edit.php";
} elseif ($action == "delete") {
    $maHP = $_GET['MaHP'] ?? null;
    
    if ($maHP && $hocPhan->delete($maHP)) {
        header("Location: ?page=hocphan&action=index");
    }
}
