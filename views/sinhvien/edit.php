<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin sinh viên</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Sửa thông tin sinh viên</h2>
    <form method="POST" action="?page=sinhvien&action=edit">
        <input type="hidden" name="MaSV" value="<?= $sv['MaSV'] ?>">
        
        <div class="form-group">
            <label>Mã SV:</label>
            <input type="text" value="<?= $sv['MaSV'] ?>" class="form-control" disabled>
        </div>
        
        <div class="form-group">
            <label>Họ tên:</label>
            <input type="text" name="HoTen" value="<?= $sv['HoTen'] ?>" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Giới tính:</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam" <?= $sv['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                <option value="Nữ" <?= $sv['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Ngày sinh:</label>
            <input type="date" name="NgaySinh" value="<?= $sv['NgaySinh'] ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Hình:</label>
            <input type="text" name="Hinh" value="<?= $sv['Hinh'] ?>" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Ngành:</label>
            <select name="MaNganh" class="form-control">
                <option value="CNTT" <?= $sv['MaNganh'] == 'CNTT' ? 'selected' : '' ?>>Công nghệ thông tin</option>
                <option value="QTKD" <?= $sv['MaNganh'] == 'QTKD' ? 'selected' : '' ?>>Quản trị kinh doanh</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="?page=sinhvien&action=index" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>
