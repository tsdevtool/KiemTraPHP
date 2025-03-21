<?php
// Include header first to ensure session is started before any HTML output
include "views/header.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách học phần</title>
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
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            color: white;
            border-bottom: none;
            padding: 1.25rem;
            font-weight: bold;
        }
        .table {
            margin-bottom: 0;
        }
        .table th {
            border-top: none;
            background-color: rgba(247, 151, 30, 0.1);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        .table td, .table th {
            vertical-align: middle;
            padding: 0.75rem 1rem;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(247, 151, 30, 0.05);
        }
        .badge {
            padding: 0.5em 0.75em;
            font-weight: 500;
            border-radius: 30px;
        }
        .badge-info {
            background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%);
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
        .btn-danger {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            border: none;
        }
        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }
        .btn-group .btn {
            margin: 0 2px;
        }
        .no-data-container {
            text-align: center;
            padding: 3rem;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
        }
        .no-data-icon {
            font-size: 4rem;
            color: #f7971e;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
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
        .search-container {
            margin-bottom: 1.5rem;
        }
        .search-box {
            position: relative;
        }
        .search-input {
            padding-left: 40px;
            height: 50px;
            border-radius: 25px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            width: 100%;
            transition: all 0.3s;
        }
        .search-input:focus {
            box-shadow: 0 6px 18px rgba(0,0,0,0.2);
            border-color: #f7971e;
        }
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
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
    <?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
        <i class="fas fa-check-circle mr-2"></i> <?= $_SESSION['success'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['success']); endif; ?>
    
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
                <h4 class="m-0 font-weight-bold"><i class="fas fa-book mr-2"></i>Danh sách học phần</h4>
            </div>
            <div>
                <a href="?page=hocphan&action=create" class="btn btn-success">
                    <i class="fas fa-plus-circle mr-1"></i> Thêm học phần
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <?php if (count($listHP) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 15%">Mã học phần</th>
                            <th style="width: 20%">Tên học phần</th>
                            <th style="width: 15%" class="text-center">Số tín chỉ</th>
                            <th style="width: 30%" class="text-center">Số lượng đăng ký/Dự kiến</th>
                            <th style="width: 20%" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listHP as $hp): ?>
                        <tr>
                            <td class="font-weight-bold"><?= $hp['MaHP'] ?></td>
                            <td><?= $hp['TenHP'] ?></td>
                            <td class="text-center">
                                <span class="badge badge-info">
                                    <i class="fas fa-award mr-1"></i> <?= $hp['SoTinChi'] ?> tín chỉ
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="progress" style="height: 20px;">
                                    <?php 
                                    $count = count($dangky->findByMaHP($hp['MaHP']));
                                    $maxSeats = isset($hp['SoLuong']) && $hp['SoLuong'] > 0 ? $hp['SoLuong'] : 40;
                                    $percent = $count > 0 ? ($count / $maxSeats) * 100 : 0;
                                    $colorClass = $percent < 30 ? "bg-info" : ($percent < 70 ? "bg-warning" : "bg-danger");
                                    ?>
                                    <div class="progress-bar progress-bar-striped progress-bar-animated <?= $colorClass ?>" 
                                         role="progressbar" 
                                         style="width: <?= $percent ?>%" 
                                         aria-valuenow="<?= $count ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="<?= $maxSeats ?>">
                                         <?= $count ?>/<?= $maxSeats ?>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block">
                                    <i class="fas fa-users mr-1"></i> Dự kiến: <?= $maxSeats ?> sinh viên tham gia
                                </small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="?page=hocphan&action=edit&MaHP=<?= $hp['MaHP'] ?>" class="btn btn-warning btn-sm" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" onclick="confirmDelete('<?= $hp['MaHP'] ?>')" class="btn btn-danger btn-sm" title="Xóa">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    
                                    <?php 
                                    // Only show registration button for logged-in students
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_SESSION['MaSV'])): 
                                        // Check if student already registered for this course
                                        $alreadyRegistered = false;
                                        if (isset($_SESSION['MaSV'])) {
                                            $registeredCourses = $dangky->getRegisteredCourses($_SESSION['MaSV']);
                                            foreach ($registeredCourses as $course) {
                                                if ($course['MaHP'] == $hp['MaHP']) {
                                                    $alreadyRegistered = true;
                                                    break;
                                                }
                                            }
                                        }
                                        
                                        // Check if course is full (count >= SoLuong)
                                        $isFull = $count >= $hp['SoLuong'];
                                        
                                        if (!$alreadyRegistered && !$isFull):
                                    ?>
                                    <a href="?page=dangky&action=register&MaHP=<?= $hp['MaHP'] ?>" class="btn btn-primary btn-sm" title="Đăng ký học phần">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                    <?php 
                                        elseif ($alreadyRegistered): 
                                    ?>
                                    <button class="btn btn-success btn-sm" disabled title="Đã đăng ký">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <?php 
                                        elseif ($isFull): 
                                    ?>
                                    <button class="btn btn-secondary btn-sm" disabled title="Vượt quá số lượng dự kiến">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                    <?php 
                                        endif;
                                    endif; 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="no-data-container">
                <div class="no-data-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h5 class="mb-3">Chưa có học phần nào được tạo</h5>
                <a href="?page=hocphan&action=create" class="btn btn-success">
                    <i class="fas fa-plus-circle mr-1"></i> Thêm học phần đầu tiên
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
                </div>
                <p>Bạn có chắc chắn muốn xóa học phần này? Hành động này không thể hoàn tác.</p>
                <p><small class="text-danger"><i class="fas fa-info-circle mr-1"></i>Lưu ý: Việc xóa học phần sẽ xóa tất cả đăng ký liên quan.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Xác nhận xóa</a>
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

    function confirmDelete(id) {
        $('#confirmDeleteBtn').attr('href', '?page=hocphan&action=delete&MaHP=' + id);
        $('#confirmDeleteModal').modal('show');
    }
    
    // Auto close alerts after 5 seconds
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 5000);
</script>
</body>
</html>
