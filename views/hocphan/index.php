<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách học phần</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Danh sách học phần</h2>
    <div class="mb-3">
        <a href="?page=hocphan&action=create" class="btn btn-success">Thêm học phần</a>
        <a href="?page=sinhvien&action=index" class="btn btn-primary">Quản lý sinh viên</a>
        <a href="?page=dangky&action=list" class="btn btn-info">Xem đăng ký học phần</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã HP</th>
                <th>Tên học phần</th>
                <th>Số tín chỉ</th>
                <th>Số lượng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $hp) { ?>
                <tr>
                    <td><?= $hp['MaHP'] ?></td>
                    <td><?= $hp['TenHP'] ?></td>
                    <td><?= $hp['SoTinChi'] ?></td>
                    <td><?= $hp['SoLuong'] ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="?page=hocphan&action=edit&MaHP=<?= $hp['MaHP'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="?page=hocphan&action=delete&MaHP=<?= $hp['MaHP'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa học phần này không?')">Xóa</a>
                            <a href="?page=dangky&action=register&MaHP=<?= $hp['MaHP'] ?>" class="btn btn-success btn-sm">Đăng ký</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
