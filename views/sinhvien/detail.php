<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sinh viên</title>
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
            max-width: 1000px;
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
            background: linear-gradient(135deg, #0072ff 0%, #00c6ff 100%);
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
        .btn-secondary {
            background: linear-gradient(135deg, #8e9eab 0%, #eef2f3 100%);
            border: none;
            color: #555;
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
        .btn-primary {
            background: linear-gradient(135deg, #0072ff 0%, #00c6ff 100%);
            border: none;
        }
        .student-image-container {
            position: relative;
            margin: 0 auto;
            width: 250px;
            height: 250px;
            margin-bottom: 20px;
        }
        .student-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 5px solid white;
            transition: all 0.3s;
        }
        .student-image-container::after {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border-radius: 50%;
            box-shadow: 0 5px 25px rgba(0,0,0,0.2);
            z-index: -1;
        }
        .student-name {
            font-size: 2rem;
            font-weight: 700;
            margin-top: 1rem;
            color: #333;
            transition: all 0.3s;
        }
        .badge {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.9rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        .info-label {
            color: #6a11cb;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        .info-value {
            font-size: 1.1rem;
            font-weight: 500;
            color: #333;
            margin-bottom: 15px;
        }
        .student-info {
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            backdrop-filter: blur(5px);
        }
        .courses-registered {
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            backdrop-filter: blur(5px);
        }
        .courses-placeholder {
            padding: 30px 0;
            text-align: center;
            transition: all 0.3s;
        }
        .courses-placeholder i {
            font-size: 3rem;
            color: #6a11cb;
            margin-bottom: 15px;
            transition: all 0.3s;
        }
        .courses-placeholder:hover i {
            transform: scale(1.1);
        }
        .fade-in {
            animation: fadeIn 0.5s;
        }
        .student-profile {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            text-align: center;
            transition: all 0.3s;
        }
        .student-profile:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<?php include "views/header.php"; ?>
<div id="particles-bg" class="particles-bg"></div>

<div class="main-container animate__animated animate__fadeIn">
    <div class="card my-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold"><i class="fas fa-id-card mr-2"></i>Thông tin chi tiết sinh viên</h4>
            </div>
            <div>
                <a href="?page=sinhvien&action=index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Danh sách sinh viên
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="student-profile floating">
                        <div class="student-image-container">
                            <img src="<?= empty($sv['Hinh']) ? 'public/storage/images/no-avatar.png' : $sv['Hinh'] ?>" 
                                 alt="<?= $sv['HoTen'] ?>" class="rounded-circle student-image shadow">
                        </div>
                        <h3 class="student-name"><?= $sv['HoTen'] ?></h3>
                        <p class="text-muted">
                            <i class="fas fa-id-badge mr-1"></i> <?= $sv['MaSV'] ?>
                        </p>
                        <div class="my-3">
                            <?php if($sv['GioiTinh'] == 'Nam'): ?>
                                <span class="badge" style="background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%); color: white;">
                                    <i class="fas fa-male mr-1"></i> Nam
                                </span>
                            <?php else: ?>
                                <span class="badge" style="background: linear-gradient(135deg, #ec008c 0%, #fc6767 100%); color: white;">
                                    <i class="fas fa-female mr-1"></i> Nữ
                                </span>
                            <?php endif; ?>
                            
                            <span class="badge ml-2" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                                <i class="fas fa-graduation-cap mr-1"></i>
                                <?= $sv['MaNganh'] == 'CNTT' ? 'Công nghệ thông tin' : 'Quản trị kinh doanh' ?>
                            </span>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            <a href="?page=sinhvien&action=edit&MaSV=<?= $sv['MaSV'] ?>" class="btn btn-warning mx-2">
                                <i class="fas fa-edit mr-1"></i> Sửa
                            </a>
                            <a href="?page=sinhvien&action=delete&MaSV=<?= $sv['MaSV'] ?>" class="btn btn-danger mx-2" 
                               onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không?')">
                                <i class="fas fa-trash-alt mr-1"></i> Xóa
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="student-info mb-4 fade-in">
                        <h4 class="border-bottom pb-2 mb-4">
                            <i class="fas fa-info-circle mr-2"></i>Thông tin cá nhân
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-label">
                                    <i class="fas fa-id-card mr-2"></i>Mã sinh viên
                                </div>
                                <div class="info-value"><?= $sv['MaSV'] ?></div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">
                                    <i class="fas fa-user mr-2"></i>Họ và tên
                                </div>
                                <div class="info-value"><?= $sv['HoTen'] ?></div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">
                                    <i class="fas fa-venus-mars mr-2"></i>Giới tính
                                </div>
                                <div class="info-value">
                                    <?php if($sv['GioiTinh'] == 'Nam'): ?>
                                        <i class="fas fa-male text-primary mr-1"></i> Nam
                                    <?php else: ?>
                                        <i class="fas fa-female text-danger mr-1"></i> Nữ
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">
                                    <i class="fas fa-calendar-alt mr-2"></i>Ngày sinh
                                </div>
                                <div class="info-value">
                                    <?= date('d/m/Y', strtotime($sv['NgaySinh'])) ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">
                                    <i class="fas fa-graduation-cap mr-2"></i>Ngành học
                                </div>
                                <div class="info-value">
                                    <?= $sv['MaNganh'] == 'CNTT' ? 'Công nghệ thông tin' : 'Quản trị kinh doanh' ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="courses-registered fade-in">
                        <h4 class="border-bottom pb-2 mb-3">
                            <i class="fas fa-book mr-2"></i>Các học phần đã đăng ký
                        </h4>
                        
                        <div class="courses-placeholder">
                            <i class="fas fa-book-open mb-3"></i>
                            <p class="text-muted">Chưa có thông tin về các học phần đã đăng ký.</p>
                            <a href="?page=dangky&action=index" class="btn btn-primary mt-2">
                                <i class="fas fa-plus-circle mr-1"></i> Đăng ký học phần
                            </a>
                        </div>
                    </div>
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
