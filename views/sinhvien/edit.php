<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin sinh viên</title>
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
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            color: white;
            border-bottom: none;
            padding: 1.25rem;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            box-shadow: none;
            transition: all 0.3s;
            background-color: rgba(255, 255, 255, 0.9);
        }
        .form-control:focus {
            border-color: #f7971e;
            box-shadow: 0 0 0 0.2rem rgba(247, 151, 30, 0.25);
        }
        .custom-file-input {
            cursor: pointer;
        }
        .custom-file-label {
            border-radius: 10px;
            padding: 12px 15px;
            height: auto;
        }
        .custom-radio .custom-control-label::before,
        .custom-radio .custom-control-label::after,
        .custom-checkbox .custom-control-label::before,
        .custom-checkbox .custom-control-label::after {
            width: 1.25rem;
            height: 1.25rem;
        }
        .custom-control-label {
            cursor: pointer;
            padding-top: 2px;
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
        .image-preview {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s;
        }
        .image-preview img {
            max-width: 100%;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        .image-preview:hover img {
            transform: scale(1.02);
        }
        .form-container {
            background-color: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .image-upload-container {
            position: relative;
        }
        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .text-danger {
            color: #dc3545 !important;
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
                <h4 class="m-0 font-weight-bold"><i class="fas fa-user-edit mr-2"></i>Sửa thông tin sinh viên</h4>
            </div>
            <div>
                <a href="?page=sinhvien&action=index" class="btn btn-secondary">
                    <i class="fas fa-list mr-1"></i> Danh sách sinh viên
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="form-container">
                <form method="POST" action="?page=sinhvien&action=edit" enctype="multipart/form-data" class="fade-in">
                    <input type="hidden" name="MaSV" value="<?= $sv['MaSV'] ?>">
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="MaSV"><i class="fas fa-id-card mr-1"></i> Mã sinh viên:</label>
                                <input type="text" id="MaSV" value="<?= $sv['MaSV'] ?>" class="form-control bg-light" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label for="HoTen"><i class="fas fa-user mr-1"></i> Họ tên:</label>
                                <input type="text" id="HoTen" name="HoTen" value="<?= $sv['HoTen'] ?>" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                <label><i class="fas fa-venus-mars mr-1"></i> Giới tính:</label>
                                <div class="d-flex">
                                    <div class="custom-control custom-radio mr-4">
                                        <input type="radio" id="gioiTinhNam" name="GioiTinh" value="Nam" class="custom-control-input" <?= $sv['GioiTinh'] == 'Nam' ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="gioiTinhNam">
                                            <i class="fas fa-male text-primary mr-1"></i> Nam
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="gioiTinhNu" name="GioiTinh" value="Nữ" class="custom-control-input" <?= $sv['GioiTinh'] == 'Nữ' ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="gioiTinhNu">
                                            <i class="fas fa-female text-danger mr-1"></i> Nữ
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="NgaySinh"><i class="fas fa-calendar-alt mr-1"></i> Ngày sinh:</label>
                                <input type="date" id="NgaySinh" name="NgaySinh" value="<?= $sv['NgaySinh'] ?>" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="MaNganh"><i class="fas fa-graduation-cap mr-1"></i> Ngành học:</label>
                                <select id="MaNganh" name="MaNganh" class="form-control custom-select">
                                    <option value="CNTT" <?= $sv['MaNganh'] == 'CNTT' ? 'selected' : '' ?>>Công nghệ thông tin</option>
                                    <option value="QTKD" <?= $sv['MaNganh'] == 'QTKD' ? 'selected' : '' ?>>Quản trị kinh doanh</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group text-center">
                                <label><i class="fas fa-image mr-1"></i> Hình đại diện:</label>
                                <div class="image-upload-container mt-2 floating">
                                    <div class="image-preview mb-3">
                                        <img id="preview" src="<?= empty($sv['Hinh']) ? 'public/storage/images/no-avatar.png' : $sv['Hinh'] ?>" class="img-fluid" 
                                            style="width: 200px; height: 200px; object-fit: cover;">
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="hinhAnh" name="hinhAnh" accept="image/*" onchange="previewImage(this)">
                                        <label class="custom-file-label" for="hinhAnh">Chọn ảnh mới...</label>
                                    </div>
                                    <!-- Trường ẩn để lưu đường dẫn hình ảnh hiện tại -->
                                    <input type="hidden" name="Hinh" value="<?= $sv['Hinh'] ?>">
                                    <small class="form-text text-muted mt-2">Chấp nhận file JPG, PNG hoặc GIF. Dung lượng tối đa 2MB.</small>
                                    
                                    <?php if (!empty($sv['Hinh'])): ?>
                                    <div class="mt-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="xoaHinh" name="xoaHinh" value="1">
                                            <label class="custom-control-label text-danger" for="xoaHinh">
                                                <i class="fas fa-trash-alt mr-1"></i> Xóa hình ảnh hiện tại
                                            </label>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-4 d-flex justify-content-center">
                        <a href="?page=sinhvien&action=index" class="btn btn-secondary mx-2">
                            <i class="fas fa-times mr-1"></i> Hủy
                        </a>
                        <button type="submit" class="btn btn-warning text-white mx-2">
                            <i class="fas fa-save mr-1"></i> Cập nhật
                        </button>
                    </div>
                </form>
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

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
        
        // Hiển thị tên file đã chọn
        $(input).next('.custom-file-label').html(input.files[0].name);
    }
}

// Fix cho Bootstrap custom file input
$('.custom-file-input').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').html(fileName);
});

// Xử lý checkbox xóa hình
$('#xoaHinh').change(function() {
    if($(this).is(':checked')) {
        $('#preview').attr('src', 'public/storage/images/no-avatar.png');
        $('#hinhAnh').prop('disabled', true);
    } else {
        $('#preview').attr('src', '<?= empty($sv['Hinh']) ? 'public/storage/images/no-avatar.png' : $sv['Hinh'] ?>');
        $('#hinhAnh').prop('disabled', false);
    }
});
</script>
</body>
</html>
