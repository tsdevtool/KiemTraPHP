<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký học phần</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
</head>
<body>
<?php include "views/header.php"; ?>
<div class="container">
    <h2>Đăng ký học phần</h2>
    <div class="mb-3">
        <a href="?page=dangky&action=list" class="btn btn-info">Xem học phần đã đăng ký</a>
        <a href="?page=hocphan&action=index" class="btn btn-secondary">Quay lại</a>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã HP</th>
                <th>Tên học phần</th>
                <th>Số tín chỉ</th>
                <th>Số lượng còn lại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $hp) { 
                $soLuong = isset($hp['SoLuong']) ? $hp['SoLuong'] : 10;
            ?>
                <tr>
                    <td><?= $hp['MaHP'] ?></td>
                    <td><?= $hp['TenHP'] ?></td>
                    <td><?= $hp['SoTinChi'] ?></td>
                    <td><?= $soLuong ?></td>
                    <td>
                        <?php if ($soLuong > 0) { ?>
                            <a href="?page=dangky&action=register&MaHP=<?= $hp['MaHP'] ?>" class="btn btn-success btn-sm">Đăng ký</a>
                        <?php } else { ?>
                            <button class="btn btn-secondary btn-sm" disabled>Hết chỗ</button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>