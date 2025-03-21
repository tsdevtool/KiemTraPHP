<?php
// Include header first to ensure session is started before any HTML output
include "views/header.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách đăng ký học phần</title>
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
        .badge-primary {
            background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
        }
        .badge-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        .badge-info {
            background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%);
        }
        .badge-danger {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
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
        .filter-container {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .filter-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: #495057;
            border-bottom: 2px solid #f8f9fa;
            padding-bottom: 10px;
        }
        .select2-container--default .select2-selection--single {
            height: 38px;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
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
    
    <div class="filter-container animate__animated animate__fadeInUp">
        <h5 class="filter-title"><i class="fas fa-filter mr-2"></i>Lọc danh sách đăng ký</h5>
        <form method="GET" action="" class="row">
            <input type="hidden" name="page" value="dangky">
            <input type="hidden" name="action" value="index">
            
            <div class="col-md-4 mb-3">
                <label for="MaSV"><i class="fas fa-user-graduate mr-1"></i> Sinh viên:</label>
                <select name="MaSV" id="MaSV" class="form-control select2">
                    <option value="">-- Tất cả sinh viên --</option>
                    <?php foreach ($sinhviens as $sv): ?>
                    <option value="<?= $sv['MaSV'] ?>" <?= (isset($_GET['MaSV']) && $_GET['MaSV'] == $sv['MaSV']) ? 'selected' : '' ?>>
                        <?= $sv['MaSV'] ?> - <?= $sv['HoTen'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-4 mb-3">
                <label for="MaHP"><i class="fas fa-book mr-1"></i> Học phần:</label>
                <select name="MaHP" id="MaHP" class="form-control select2">
                    <option value="">-- Tất cả học phần --</option>
                    <?php foreach ($hocphans as $hp): ?>
                    <option value="<?= $hp['MaHP'] ?>" <?= (isset($_GET['MaHP']) && $_GET['MaHP'] == $hp['MaHP']) ? 'selected' : '' ?>>
                        <?= $hp['MaHP'] ?> - <?= $hp['TenHP'] ?> (<?= $hp['SoTC'] ?> TC)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-4 d-flex align-items-end mb-3">
                <button type="submit" class="btn btn-primary mr-2">
                    <i class="fas fa-search mr-1"></i> Lọc
                </button>
                <a href="?page=dangky&action=index" class="btn btn-secondary">
                    <i class="fas fa-sync-alt mr-1"></i> Đặt lại
                </a>
            </div>
        </form>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="m-0 font-weight-bold"><i class="fas fa-clipboard-list mr-2"></i>Danh sách đăng ký học phần</h4>
            </div>
            <div>
                <a href="?page=dangky&action=create" class="btn btn-success">
                    <i class="fas fa-plus-circle mr-1"></i> Đăng ký mới
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <?php if (count($list) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 20%">Sinh viên</th>
                            <th style="width: 20%">Học phần</th>
                            <th style="width: 10%" class="text-center">Số tín chỉ</th>
                            <th style="width: 15%" class="text-center">Ngày đăng ký</th>
                            <th style="width: 15%" class="text-center">Trạng thái</th>
                            <th style="width: 15%" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $key => $item): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php 
                                    $svDetail = $sinhvien->findById($item['MaSV']);
                                    $avatar = !empty($svDetail['Hinh']) ? $svDetail['Hinh'] : 'public/storage/images/no-avatar.png';
                                    ?>
                                    <img src="<?= $avatar ?>" class="rounded-circle mr-2" width="40" height="40" style="object-fit: cover">
                                    <div>
                                        <div class="font-weight-bold"><?= $item['MaSV'] ?></div>
                                        <small><?= $svDetail['HoTen'] ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php $hpDetail = $hocphan->findById($item['MaHP']); ?>
                                <div class="font-weight-bold"><?= $item['MaHP'] ?></div>
                                <small><?= $hpDetail['TenHP'] ?></small>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-info">
                                    <i class="fas fa-award mr-1"></i> <?= $hpDetail['SoTC'] ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?= date('d/m/Y', strtotime($item['NgayDK'])) ?>
                            </td>
                            <td class="text-center">
                                <?php if ($item['TrangThai'] == 1): ?>
                                <span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i> Đã duyệt</span>
                                <?php else: ?>
                                <span class="badge badge-warning"><i class="fas fa-clock mr-1"></i> Chờ duyệt</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <?php if ($item['TrangThai'] == 0): ?>
                                    <a href="?page=dangky&action=approve&id=<?= $item['id'] ?>" class="btn btn-success btn-sm" title="Duyệt">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <?php endif; ?>
                                    <a href="javascript:void(0);" onclick="confirmDelete('<?= $item['id'] ?>')" class="btn btn-danger btn-sm" title="Hủy đăng ký">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h5 class="mb-3">Chưa có đăng ký học phần nào</h5>
                <a href="?page=dangky&action=create" class="btn btn-success">
                    <i class="fas fa-plus-circle mr-1"></i> Tạo đăng ký mới
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
                <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận hủy đăng ký</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
                </div>
                <p>Bạn có chắc chắn muốn hủy đăng ký học phần này? Hành động này không thể hoàn tác.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Xác nhận hủy</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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
    });

    function confirmDelete(id) {
        $('#confirmDeleteBtn').attr('href', '?page=dangky&action=delete&id=' + id);
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