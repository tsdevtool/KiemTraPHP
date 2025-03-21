<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa học phần</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Sửa thông tin học phần</h2>
    <form method="POST" action="?page=hocphan&action=edit">
        <input type="hidden" name="MaHP" value="<?= $hp['MaHP'] ?>">
        
        <div class="form-group">
            <label>Mã học phần:</label>
            <input type="text" value="<?= $hp['MaHP'] ?>" class="form-control" disabled>
        </div>
        
        <div class="form-group">
            <label>Tên học phần:</label>
            <input type="text" name="TenHP" value="<?= $hp['TenHP'] ?>" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Số tín chỉ:</label>
            <input type="number" name="SoTinChi" value="<?= $hp['SoTinChi'] ?>" class="form-control" required min="1" max="10">
        </div>
        
        <div class="form-group">
            <label>Số lượng sinh viên:</label>
            <input type="number" name="SoLuong" value="<?= $hp['SoLuong'] ?>" class="form-control" required min="0">
        </div>
        
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="?page=hocphan&action=index" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html> 