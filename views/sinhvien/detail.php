<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sinh viên</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Thông tin chi tiết sinh viên</h2>
    
    <div class="card">
        <div class="card-header">
            <h4><?= $sv['HoTen'] ?></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?= $sv['Hinh'] ?>" alt="<?= $sv['HoTen'] ?>" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <th>Mã sinh viên:</th>
                            <td><?= $sv['MaSV'] ?></td>
                        </tr>
                        <tr>
                            <th>Họ tên:</th>
                            <td><?= $sv['HoTen'] ?></td>
                        </tr>
                        <tr>
                            <th>Giới tính:</th>
                            <td><?= $sv['GioiTinh'] ?></td>
                        </tr>
                        <tr>
                            <th>Ngày sinh:</th>
                            <td><?= $sv['NgaySinh'] ?></td>
                        </tr>
                        <tr>
                            <th>Mã ngành:</th>
                            <td><?= $sv['MaNganh'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="?page=sinhvien&action=index" class="btn btn-secondary">Quay lại</a>
            <a href="?page=sinhvien&action=edit&MaSV=<?= $sv['MaSV'] ?>" class="btn btn-warning">Sửa</a>
        </div>
    </div>
</div>
</body>
</html>
