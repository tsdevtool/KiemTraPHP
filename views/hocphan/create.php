<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm học phần</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Thêm học phần mới</h2>
    <form method="POST" action="?page=hocphan&action=create">
        <div class="form-group">
            <label>Mã học phần:</label>
            <input type="text" name="MaHP" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Tên học phần:</label>
            <input type="text" name="TenHP" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Số tín chỉ:</label>
            <input type="number" name="SoTinChi" class="form-control" required min="1" max="10">
        </div>
        
        <div class="form-group">
            <label>Số lượng sinh viên:</label>
            <input type="number" name="SoLuong" class="form-control" required min="1">
        </div>
        
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="?page=hocphan&action=index" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html> 