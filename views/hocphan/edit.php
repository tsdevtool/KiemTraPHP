<?php
// Include header first to ensure session is started before any HTML output
include "views/header.php";

// Check if $hp is not a valid array (false or null)
if (!isset($hp) || $hp === false || !is_array($hp)) {
    // Set error message in session
    $_SESSION['error'] = "Không tìm thấy học phần hoặc ID học phần không hợp lệ!";
    // Redirect to the list page
    echo "<script>window.location.href = '?page=hocphan&action=index';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa học phần</title>
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
            max-width: 900px;
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
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            color: white;
            border-bottom: none;
            padding: 1.25rem;
            font-weight: bold;
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
        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
            border: none;
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            border: none;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            box-shadow: none;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #4b6cb7;
            box-shadow: 0 0 0 0.2rem rgba(75, 108, 183, 0.25);
        }
        .form-control:disabled {
            background-color: #f8f9fa;
            border-color: #e9ecef;
            cursor: not-allowed;
        }
        label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        .form-group {
            margin-bottom: 25px;
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
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold"><i class="fas fa-edit mr-2"></i>Sửa thông tin học phần</h4>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="?page=hocphan&action=edit" class="animate__animated animate__fadeInUp">
                <input type="hidden" name="MaHP" value="<?= $hp['MaHP'] ?>">
                
                <div class="form-group">
                    <label for="MaHP"><i class="fas fa-hashtag mr-1"></i> Mã học phần:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                        </div>
                        <input type="text" id="MaHP" value="<?= $hp['MaHP'] ?>" class="form-control" disabled>
                    </div>
                    <small class="form-text text-muted">Mã học phần không thể thay đổi</small>
                </div>
                
                <div class="form-group">
                    <label for="TenHP"><i class="fas fa-book-open mr-1"></i> Tên học phần:</label>
                    <input type="text" name="TenHP" id="TenHP" value="<?= $hp['TenHP'] ?>" class="form-control" required placeholder="Nhập tên học phần">
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="SoTinChi"><i class="fas fa-award mr-1"></i> Số tín chỉ:</label>
                            <input type="number" name="SoTinChi" id="SoTinChi" value="<?= $hp['SoTinChi'] ?>" class="form-control" required min="1" max="10" placeholder="1-10">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="SoLuong"><i class="fas fa-users mr-1"></i> Số lượng dự kiến sinh viên:</label>
                            <input type="number" name="SoLuong" id="SoLuong" value="<?= $hp['SoLuong'] ?>" class="form-control" required min="0" placeholder="Nhập số lượng dự kiến">
                            <small class="form-text text-muted">
                                <?php 
                                $count = count($dangky->findByMaHP($hp['MaHP']));
                                echo "Hiện có {$count} sinh viên đã đăng ký (dự kiến: {$hp['SoLuong']})";
                                ?>
                            </small>
                        </div>
                    </div>
                </div>
                
                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-save mr-1"></i> Cập nhật
                    </button>
                    <a href="?page=hocphan&action=index" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Quay lại
                    </a>
                </div>
            </form>
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