<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký học phần</title>
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
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            color: white;
            border-bottom: none;
            padding: 1.25rem;
            font-weight: bold;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            box-shadow: none;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #f7971e;
            box-shadow: 0 0 0 0.2rem rgba(247, 151, 30, 0.25);
        }
        .form-group label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        .form-group {
            margin-bottom: 1.5rem;
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
        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border: none;
        }
        .btn-warning {
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            border: none;
            color: white !important;
        }
        .btn-secondary {
            background: linear-gradient(135deg, #8e9eab 0%, #eef2f3 100%);
            border: none;
            color: #555;
        }
        .alert {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }
        .alert-success {
            background: linear-gradient(135deg, rgba(17, 153, 142, 0.1) 0%, rgba(56, 239, 125, 0.1) 100%);
            border-left: 4px solid #38ef7d;
            color: #11998e;
        }
        .alert-danger {
            background: linear-gradient(135deg, rgba(235, 51, 73, 0.1) 0%, rgba(244, 92, 67, 0.1) 100%);
            border-left: 4px solid #f45c43;
            color: #eb3349;
        }
        .select2-container--default .select2-selection--single {
            height: 48px;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 48px;
            padding-left: 15px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px;
            right: 10px;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #f7971e;
        }
        .form-container {
            background-color: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .hocphan-info {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
            border-left: 4px solid #f7971e;
            display: none;
        }
        .hocphan-info.active {
            display: block;
            animation: fadeIn 0.5s;
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
    <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i> <?= $_SESSION['error'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['error']); endif; ?>
    
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold"><i class="fas fa-clipboard-list mr-2"></i>Đăng ký học phần mới</h4>
            </div>
            <div>
                <a href="?page=dangky&action=index" class="btn btn-secondary">
                    <i class="fas fa-list mr-1"></i> Danh sách đăng ký
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="form-container">
                <form method="POST" action="?page=dangky&action=store" class="fade-in">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="MaSV"><i class="fas fa-user-graduate mr-1"></i> Sinh viên:</label>
                                <select name="MaSV" id="MaSV" class="form-control select2" required>
                                    <option value="">-- Chọn sinh viên --</option>
                                    <?php foreach ($sinhviens as $sv): ?>
                                    <option value="<?= $sv['MaSV'] ?>">
                                        <?= $sv['MaSV'] ?> - <?= $sv['HoTen'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="hocphan-info" id="sinhvien-info">
                                <div class="d-flex align-items-center">
                                    <div class="student-avatar mr-3">
                                        <img src="" id="student-avatar" class="rounded-circle" width="60" height="60" style="object-fit: cover;">
                                    </div>
                                    <div>
                                        <h5 class="mb-1" id="student-name"></h5>
                                        <p class="mb-0 text-muted" id="student-details"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="MaHP"><i class="fas fa-book mr-1"></i> Học phần:</label>
                                <select name="MaHP" id="MaHP" class="form-control select2" required>
                                    <option value="">-- Chọn học phần --</option>
                                    <?php foreach ($hocphans as $hp): ?>
                                    <option value="<?= $hp['MaHP'] ?>" data-sotc="<?= $hp['SoTC'] ?>" data-tenhp="<?= $hp['TenHP'] ?>">
                                        <?= $hp['MaHP'] ?> - <?= $hp['TenHP'] ?> (<?= $hp['SoTC'] ?> TC)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="hocphan-info" id="hocphan-info">
                                <h5 class="mb-2" id="hocphan-name"></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <span class="badge badge-info">
                                            <i class="fas fa-award mr-1"></i> <span id="hocphan-sotc"></span> tín chỉ
                                        </span>
                                    </div>
                                    <div>
                                        <span class="badge badge-primary">
                                            <i class="fas fa-users mr-1"></i> Đã đăng ký: <span id="hocphan-dangky">0</span>/40
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-4 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success mx-2">
                            <i class="fas fa-check-circle mr-1"></i> Đăng ký học phần
                        </button>
                        <a href="?page=dangky&action=index" class="btn btn-secondary mx-2">
                            <i class="fas fa-times mr-1"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Chọn...",
            allowClear: true,
            width: '100%'
        });
        
        $('#MaHP').change(function() {
            if ($(this).val()) {
                var selectedOption = $(this).find('option:selected');
                var tenHP = selectedOption.data('tenhp');
                var soTC = selectedOption.data('sotc');
                var maHP = $(this).val();
                
                // Hiển thị thông tin học phần
                $('#hocphan-name').text(tenHP);
                $('#hocphan-sotc').text(soTC);
                
                // Gọi API để lấy số lượng đăng ký
                $.ajax({
                    url: '?page=dangky&action=count&id=' + maHP,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#hocphan-dangky').text(response.count);
                    },
                    error: function() {
                        $('#hocphan-dangky').text('0');
                    }
                });
                
                $('#hocphan-info').addClass('active');
            } else {
                $('#hocphan-info').removeClass('active');
            }
        });
        
        $('#MaSV').change(function() {
            if ($(this).val()) {
                var maSV = $(this).val();
                
                // Gọi API để lấy thông tin sinh viên
                $.ajax({
                    url: '?page=sinhvien&action=api_detail&id=' + maSV,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#student-name').text(response.HoTen);
                        $('#student-details').text(response.MaNganh + ' - ' + response.GioiTinh);
                        $('#student-avatar').attr('src', response.Hinh ? response.Hinh : 'public/storage/images/no-avatar.png');
                        $('#sinhvien-info').addClass('active');
                    },
                    error: function() {
                        $('#sinhvien-info').removeClass('active');
                    }
                });
            } else {
                $('#sinhvien-info').removeClass('active');
            }
        });
        
        // Auto close alerts after 5 seconds
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);
    });
</script>
</body>
</html> 