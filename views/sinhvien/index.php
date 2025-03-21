<?php
// Include header first to ensure session is started before any HTML output
include "views/header.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            background-attachment: fixed;
            min-height: 100vh;
            padding-bottom: 50px;
        }
        .particles-bg {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden;
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .card-header {
            background: linear-gradient(135deg, #4a00e0 0%, #8e2de2 100%);
            color: white;
            border-bottom: none;
            padding: 1.25rem;
        }
        .btn {
            border-radius: 50px;
            padding: .5rem 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border: none;
        }
        .btn-info {
            background: linear-gradient(135deg, #0072ff 0%, #00c6ff 100%);
            border: none;
        }
        .btn-warning {
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            border: none;
            color: white !important;
        }
        .btn-danger {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            border: none;
        }
        .table {
            border-collapse: separate;
            border-spacing: 0 5px;
            margin: 0;
        }
        .table th {
            background-color: #f8f9fa;
            border: none;
            padding: 12px 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            color: #555;
        }
        .table td {
            vertical-align: middle;
            padding: 15px;
            border-top: none;
            background-color: white;
        }
        .table tr:first-child td {
            border-top: none;
        }
        .table tr td:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .table tr td:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .img-student {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        .img-student:hover {
            transform: scale(1.1);
        }
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        .alert {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            animation: fadeInDown 0.5s ease;
        }
        .fade-in {
            animation: fadeIn 0.5s;
        }
        .badge {
            padding: 8px 12px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.85rem;
        }
        .badge-cntt {
            background: linear-gradient(135deg, #0072ff 0%, #00c6ff 100%);
            color: white;
        }
        .badge-qtkd {
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            color: white;
        }
        .badge-male {
            background-color: #4e73df;
            color: white;
        }
        .badge-female {
            background-color: #e83e8c;
            color: white;
        }
        .table-container {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 10px;
            backdrop-filter: blur(10px);
        }
        .empty-table-message {
            padding: 50px 0;
            text-align: center;
            font-size: 1.1rem;
            color: #6c757d;
        }
        .empty-table-message i {
            font-size: 3rem;
            color: #6a11cb;
            margin-bottom: 15px;
            display: block;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div id="particles-bg" class="particles-bg"></div>

<div class="main-container animate__animated animate__fadeIn">
    <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-4">
        <i class="fas fa-exclamation-circle mr-2"></i> <?= htmlspecialchars($_GET['error']) ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    
    <div class="card my-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold"><i class="fas fa-users mr-2"></i>Danh sách sinh viên</h4>
            </div>
            <div>
                <a href="?page=sinhvien&action=create" class="btn btn-success pulse-button">
                    <i class="fas fa-plus-circle mr-1"></i> Thêm sinh viên
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">Mã SV</th>
                                <th width="20%">Họ tên</th>
                                <th class="text-center" width="12%">Giới tính</th>
                                <th class="text-center" width="15%">Ngày sinh</th>
                                <th class="text-center" width="10%">Hình</th>
                                <th class="text-center" width="13%">Ngành</th>
                                <th class="text-center" width="20%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($list)): ?>
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-table-message">
                                            <i class="fas fa-user-graduate"></i>
                                            <p>Không có sinh viên nào trong hệ thống</p>
                                            <a href="?page=sinhvien&action=create" class="btn btn-primary">
                                                <i class="fas fa-plus-circle mr-1"></i> Thêm sinh viên đầu tiên
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($list as $sv): ?>
                                    <tr class="fade-in">
                                        <td class="text-center font-weight-bold"><?= $sv['MaSV'] ?></td>
                                        <td>
                                            <a href="?page=sinhvien&action=detail&MaSV=<?= $sv['MaSV'] ?>" class="text-decoration-none text-dark">
                                                <?= $sv['HoTen'] ?>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?php if($sv['GioiTinh'] == 'Nam'): ?>
                                                <span class="badge badge-male"><i class="fas fa-male mr-1"></i> Nam</span>
                                            <?php else: ?>
                                                <span class="badge badge-female"><i class="fas fa-female mr-1"></i> Nữ</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= date('d/m/Y', strtotime($sv['NgaySinh'])) ?>
                                        </td>
                                        <td class="text-center">
                                            <img src="<?= empty($sv['Hinh']) ? 'public/storage/images/no-avatar.png' : $sv['Hinh'] ?>" 
                                                alt="<?= $sv['HoTen'] ?>" class="img-student">
                                        </td>
                                        <td class="text-center">
                                            <?php if($sv['MaNganh'] == 'CNTT'): ?>
                                                <span class="badge badge-cntt">
                                                    <i class="fas fa-laptop-code mr-1"></i> CNTT
                                                </span>
                                            <?php else: ?>
                                                <span class="badge badge-qtkd">
                                                    <i class="fas fa-chart-line mr-1"></i> QTKD
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="?page=sinhvien&action=detail&MaSV=<?= $sv['MaSV'] ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-info-circle mr-1"></i> Chi tiết
                                                </a>
                                                <a href="?page=sinhvien&action=edit&MaSV=<?= $sv['MaSV'] ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit mr-1"></i> Sửa
                                                </a>
                                                <a href="?page=sinhvien&action=delete&MaSV=<?= $sv['MaSV'] ?>" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không?')">
                                                    <i class="fas fa-trash-alt mr-1"></i> Xóa
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        particlesJS("particles-bg", {
            "particles": {
                "number": {
                    "value": 50,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                },
                "opacity": {
                    "value": 0.3,
                    "random": false,
                },
                "size": {
                    "value": 3,
                    "random": true,
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.2,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 1,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
            },
            "retina_detect": true
        });
    });
</script>
</body>
</html>
