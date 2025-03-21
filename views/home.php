<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ thống quản lý sinh viên</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="public/assets/custom.css">
    <style>
        .welcome-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 60px 0;
            color: white;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .feature-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        .feature-title {
            font-weight: 700;
            margin-bottom: 10px;
        }
        .feature-description {
            color: #6c757d;
        }
        .feature-card.primary .feature-icon { color: var(--primary-color); }
        .feature-card.info .feature-icon { color: var(--info-color); }
        .feature-card.success .feature-icon { color: var(--success-color); }
        .feature-card.warning .feature-icon { color: var(--warning-color); }
        .feature-card.primary:hover { border-bottom: 3px solid var(--primary-color); }
        .feature-card.info:hover { border-bottom: 3px solid var(--info-color); }
        .feature-card.success:hover { border-bottom: 3px solid var(--success-color); }
        .feature-card.warning:hover { border-bottom: 3px solid var(--warning-color); }
        .step-card {
            position: relative;
            padding-left: 80px;
            margin-bottom: 30px;
        }
        .step-number {
            position: absolute;
            left: 0;
            top: 0;
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
        }
        .step-title {
            font-weight: 700;
            margin-bottom: 10px;
        }
        .stats-counter {
            background: white;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .stats-counter:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .counter-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
        .counter-title {
            color: #6c757d;
            font-weight: 600;
        }
        .footer {
            background: #f8f9fa;
            padding: 30px 0;
            margin-top: 60px;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
<?php include "views/header.php"; ?>

<div class="container fade-in">
    <div class="welcome-section text-center">
        <h1 class="display-4 mb-4"><i class="fas fa-graduation-cap"></i> Hệ thống quản lý sinh viên</h1>
        <p class="lead mb-4">Quản lý thông tin sinh viên, học phần và đăng ký học phần một cách đơn giản, hiệu quả</p>
        <div class="mt-4">
            <a href="?page=sinhvien&action=index" class="btn btn-light btn-lg mr-2">
                <i class="fas fa-users"></i> Quản lý sinh viên
            </a>
            <a href="?page=hocphan&action=index" class="btn btn-light btn-lg">
                <i class="fas fa-book"></i> Quản lý học phần
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="stats-counter">
                <div class="counter-icon">
                    <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                </div>
                <div class="counter-number" id="student-counter">0</div>
                <div class="counter-title">Sinh viên</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-counter">
                <div class="counter-icon">
                    <i class="fas fa-book fa-3x mb-3 text-info"></i>
                </div>
                <div class="counter-number" id="course-counter">0</div>
                <div class="counter-title">Học phần</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-counter">
                <div class="counter-icon">
                    <i class="fas fa-clipboard-list fa-3x mb-3 text-success"></i>
                </div>
                <div class="counter-number" id="registration-counter">0</div>
                <div class="counter-title">Đăng ký học phần</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-counter">
                <div class="counter-icon">
                    <i class="fas fa-graduation-cap fa-3x mb-3 text-warning"></i>
                </div>
                <div class="counter-number" id="credit-counter">0</div>
                <div class="counter-title">Tín chỉ đã đăng ký</div>
            </div>
        </div>
    </div>

    <h2 class="text-center mt-5 mb-4">Tính năng chính</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card feature-card primary">
                <div class="card-body text-center">
                    <div class="feature-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h5 class="feature-title">Quản lý sinh viên</h5>
                    <p class="feature-description">Thêm, sửa, xóa và xem thông tin chi tiết sinh viên với giao diện trực quan, dễ sử dụng.</p>
                    <a href="?page=sinhvien&action=index" class="btn btn-primary btn-sm">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card feature-card info">
                <div class="card-body text-center">
                    <div class="feature-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h5 class="feature-title">Quản lý học phần</h5>
                    <p class="feature-description">Quản lý thông tin các học phần, số tín chỉ, học kỳ và nhiều thông tin khác.</p>
                    <a href="?page=hocphan&action=index" class="btn btn-info btn-sm">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card feature-card success">
                <div class="card-body text-center">
                    <div class="feature-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h5 class="feature-title">Đăng ký học phần</h5>
                    <p class="feature-description">Sinh viên dễ dàng đăng ký các học phần, quản lý lịch học và theo dõi tín chỉ.</p>
                    <a href="?page=dangky&action=list" class="btn btn-success btn-sm">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card feature-card warning">
                <div class="card-body text-center">
                    <div class="feature-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h5 class="feature-title">Thống kê báo cáo</h5>
                    <p class="feature-description">Xem biểu đồ thống kê, phân tích dữ liệu sinh viên và đăng ký học phần.</p>
                    <a href="?page=sinhvien&action=index" class="btn btn-warning btn-sm text-white">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center mt-5 mb-4">Hướng dẫn sử dụng</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="step-card">
                <div class="step-number">1</div>
                <h4 class="step-title">Quản lý thông tin sinh viên</h4>
                <p>Thêm, sửa, xóa thông tin sinh viên từ menu Quản lý sinh viên. Bạn có thể tải lên hình ảnh, xem chi tiết và thông tin học phần đã đăng ký.</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h4 class="step-title">Quản lý học phần</h4>
                <p>Thêm học phần mới, cập nhật thông tin và xóa học phần không cần thiết từ menu Quản lý học phần.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="step-card">
                <div class="step-number">3</div>
                <h4 class="step-title">Đăng ký học phần</h4>
                <p>Sinh viên có thể đăng ký các học phần dựa trên kế hoạch học tập cá nhân. Có thể thêm hoặc hủy đăng ký dễ dàng.</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h4 class="step-title">Xem thống kê</h4>
                <p>Xem thông tin thống kê, biểu đồ phân bố tín chỉ theo học kỳ và tổng số tín chỉ đã đăng ký.</p>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="fas fa-graduation-cap"></i> Hệ thống quản lý sinh viên</h5>
                <p class="text-muted">Phần mềm quản lý thông tin sinh viên, học phần và đăng ký học phần hiệu quả.</p>
            </div>
            <div class="col-md-3">
                <h5>Liên kết</h5>
                <ul class="list-unstyled">
                    <li><a href="?page=sinhvien&action=index"><i class="fas fa-users"></i> Quản lý sinh viên</a></li>
                    <li><a href="?page=hocphan&action=index"><i class="fas fa-book"></i> Quản lý học phần</a></li>
                    <li><a href="?page=dangky&action=list"><i class="fas fa-clipboard-list"></i> Đăng ký học phần</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Thông tin</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-envelope"></i> Email: info@example.com</li>
                    <li><i class="fas fa-phone"></i> Hotline: 1900-1234</li>
                    <li><i class="fas fa-map-marker-alt"></i> Địa chỉ: 123 Đường ABC, TP. XYZ</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p class="text-muted">© 2023 Hệ thống quản lý sinh viên. Tất cả các quyền được bảo lưu.</p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Tạo hiệu ứng đếm số
function countUp(element, target, duration) {
    let start = 0;
    const increment = target / (duration / 50);
    const timer = setInterval(() => {
        start += increment;
        element.textContent = Math.floor(start);
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        }
    }, 50);
}

document.addEventListener('DOMContentLoaded', function() {
    // Giả lập số liệu thống kê
    countUp(document.getElementById('student-counter'), 150, 1500);
    countUp(document.getElementById('course-counter'), 48, 1500);
    countUp(document.getElementById('registration-counter'), 324, 1500);
    countUp(document.getElementById('credit-counter'), 1280, 1500);
});
</script>
</body>
</html> 