<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Học phần đã đăng ký</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Học phần đã đăng ký</h2>
    <div class="mb-3">
        <a href="?page=hocphan&action=index" class="btn btn-primary">Tiếp tục đăng ký</a>
        <a href="?page=dangky&action=clear" class="btn btn-warning" onclick="return confirm('Bạn có chắc muốn xóa tất cả học phần đã đăng ký?')">Xóa tất cả</a>
    </div>
    
    <?php if (empty($list)): ?>
        <div class="alert alert-info">
            Bạn chưa đăng ký học phần nào. <a href="?page=hocphan&action=index">Đăng ký ngay</a>
        </div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã HP</th>
                    <th>Tên học phần</th>
                    <th>Số tín chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalCredits = 0;
                foreach ($list as $hp) { 
                    $totalCredits += $hp['SoTinChi'];
                ?>
                    <tr>
                        <td><?= $hp['MaHP'] ?></td>
                        <td><?= $hp['TenHP'] ?></td>
                        <td><?= $hp['SoTinChi'] ?></td>
                        <td>
                            <a href="?page=dangky&action=remove&MaHP=<?= $hp['MaHP'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
                <tr class="table-info">
                    <td colspan="2"><strong>Tổng số tín chỉ:</strong></td>
                    <td colspan="2"><strong><?= $totalCredits ?></strong></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
