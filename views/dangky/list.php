<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học phần đã đăng ký</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/custom.css">
</head>
<body>
<?php include "views/header.php"; ?>

<div class="container-fluid px-4">
    <div class="card my-4 shadow-sm fade-in">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold"><i class="fas fa-clipboard-list mr-2"></i>Học phần đã đăng ký</h4>
            </div>
            <div>
                <a href="?page=hocphan&action=index" class="btn btn-primary">
                    <i class="fas fa-plus-circle mr-1"></i> Tiếp tục đăng ký
                </a>
                <?php if (!empty($list)): ?>
                    <a href="?page=dangky&action=clear" class="btn btn-danger ml-2" 
                       onclick="return confirm('Bạn có chắc muốn xóa tất cả học phần đã đăng ký?')">
                        <i class="fas fa-trash mr-1"></i> Xóa tất cả
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-body">
            <?php if (empty($list)): ?>
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Bạn chưa đăng ký học phần nào. 
                    <a href="?page=hocphan&action=index" class="alert-link">Đăng ký ngay</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="15%">Mã HP</th>
                                <th>Tên học phần</th>
                                <th width="15%" class="text-center">Số tín chỉ</th>
                                <th width="15%" class="text-center">Thao tác</th>
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
                                    <td class="text-center"><?= $hp['SoTinChi'] ?></td>
                                    <td class="text-center">
                                        <a href="?page=dangky&action=remove&MaHP=<?= $hp['MaHP'] ?>" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Hủy đăng ký
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="card mt-3 bg-gradient-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="m-0"><i class="fas fa-calculator mr-2"></i>Tổng số tín chỉ:</h5>
                        <h3 class="m-0"><?= $totalCredits ?></h3>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
