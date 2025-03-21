<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }
        .particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }
        .login-card {
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            transform: translateY(0);
            transition: all 0.5s;
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .login-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .login-header::before {
            content: '';
            position: absolute;
            width: 210%;
            height: 200%;
            background: rgba(255,255,255,0.1);
            top: -10%;
            left: -30%;
            transform: rotate(35deg);
            pointer-events: none;
        }
        .login-body {
            padding: 40px 30px;
            background: white;
        }
        .login-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .login-icon {
            font-size: 60px;
            margin-bottom: 15px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
        }
        .login-title {
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        .btn-login {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 30px;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 5px 15px rgba(42, 83, 252, 0.4);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(42, 83, 252, 0.5);
        }
        .btn-login::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -100%;
            width: 300%;
            height: 200%;
            background: rgba(255,255,255,0.1);
            transform: rotate(35deg);
            transition: all 0.5s;
        }
        .btn-login:hover::after {
            left: 100%;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 20px;
            height: auto;
            border: 1px solid #e0e0e0;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.2);
            border-color: #6a11cb;
        }
        .test-accounts {
            margin-top: 25px;
            padding: 20px;
            border-radius: 10px;
            background: #f1f9ff;
            border-left: 5px solid #2575fc;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        .form-group label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }
        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <div id="particles-js" class="particles-js"></div>

    <div class="login-card animate__animated animate__fadeIn">
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h3 class="login-title">ĐĂNG NHẬP</h3>
            <p>Hệ thống Quản lý Sinh viên</p>
        </div>
        <div class="login-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle mr-2"></i> <?= $error ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="?page=auth&action=login">
                <div class="form-group">
                    <label><i class="fas fa-id-card mr-2"></i>Mã Sinh Viên:</label>
                    <input type="text" name="MaSV" class="form-control" placeholder="Nhập mã sinh viên của bạn" required autofocus>
                </div>
                
                <div class="test-accounts">
                    <h6><i class="fas fa-info-circle mr-2"></i>Hướng dẫn đăng nhập:</h6>
                    <p class="mb-1">Bạn cần nhập mã của một sinh viên đã tồn tại trong hệ thống.</p>
                    <p class="mb-1">Nếu chưa có sinh viên nào, bạn có thể <a href="?page=sinhvien&action=create" class="font-weight-bold">thêm sinh viên mới</a>.</p>
                </div>
                
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-login btn-block">
                        <i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập ngay
                    </button>
                </div>
            </form>
        </div>
        <div class="login-footer">
            <a href="?page=home" class="btn btn-link text-primary">
                <i class="fas fa-home mr-1"></i> Trang chủ
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            particlesJS("particles-js", {
                "particles": {
                    "number": {
                        "value": 80,
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
                        "value": 0.5,
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
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 2,
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
                    "modes": {
                        "grab": {
                            "distance": 140,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "push": {
                            "particles_nb": 4
                        }
                    }
                },
                "retina_detect": true
            });
        });
    </script>
</body>
</html>
