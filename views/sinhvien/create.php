<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Thêm sinh viên mới</h2>
    <form method="POST" action="?page=sinhvien&action=create">
        <div class="form-group">
            <label>Mã SV:</label>
            <input type="text" name="MaSV" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Họ tên:</label>
            <input type="text" name="HoTen" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Giới tính:</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Ngày sinh:</label>
            <input type="date" name="NgaySinh" class="form-control">
        </div>
        
        <div class="form-group">
            <label>Hình:</label>
            <input type="text" name="Hinh" class="form-control" placeholder="Đường dẫn hình ảnh">
        </div>
        
        <div class="form-group">
            <label>Ngành:</label>
            <select name="MaNganh" class="form-control">
                <option value="CNTT">Công nghệ thông tin</option>
                <option value="QTKD">Quản trị kinh doanh</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="?page=sinhvien&action=index" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>
