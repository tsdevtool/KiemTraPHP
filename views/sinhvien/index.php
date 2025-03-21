<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Danh sách sinh viên</h2>
    <div class="mb-3">
        <a href="?page=sinhvien&action=create" class="btn btn-success">Thêm sinh viên</a>
        <a href="?page=hocphan&action=index" class="btn btn-primary">Quản lý học phần</a>
        <a href="?page=dangky&action=list" class="btn btn-info">Xem đăng ký học phần</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Hình</th>
                <th>Ngành</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $sv) { ?>
                <tr>
                    <td><?= $sv['MaSV'] ?></td>
                    <td><?= $sv['HoTen'] ?></td>
                    <td><?= $sv['GioiTinh'] ?></td>
                    <td><?= $sv['NgaySinh'] ?></td>
                    <td><img src="<?= $sv['Hinh'] ?>" width="50" height="50" class="img-thumbnail"></td>
                    <td><?= $sv['MaNganh'] ?></td>
                    <td>
                        <a href="?page=sinhvien&action=detail&MaSV=<?= $sv['MaSV'] ?>" class="btn btn-info btn-sm">Chi tiết</a>
                        <a href="?page=sinhvien&action=edit&MaSV=<?= $sv['MaSV'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="?page=sinhvien&action=delete&MaSV=<?= $sv['MaSV'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không?')">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
