<?php
// Session is now started in init.php, which is included by router.php
// No need to start session here
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .top-navbar {
            background: linear-gradient(90deg, #4361ee, #3a0ca3);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 8px 0;
        }
        
        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 95%;
            margin: 0 auto;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }
        
        .navbar-brand i {
            margin-right: 10px;
        }
        
        .navbar-menu {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 10px;
        }
        
        .navbar-item a {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .navbar-item a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        .navbar-item a.active {
            background: rgba(255, 255, 255, 0.25);
            font-weight: 600;
        }
        
        .navbar-item i {
            margin-right: 8px;
            font-size: 16px;
        }
        
        .user-menu {
            margin-left: auto;
        }
        
        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .navbar-brand {
                margin-bottom: 15px;
            }
            
            .navbar-menu {
                flex-direction: column;
                width: 100%;
            }
            
            .user-menu {
                margin-left: 0;
                margin-top: 10px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="top-navbar">
        <div class="navbar-container">
            <a href="?page=sinhvien&action=index" class="navbar-brand">
                <i class="fas fa-graduation-cap"></i>QLHP
            </a>
            
            <ul class="navbar-menu">
                <li class="navbar-item">
                    <a class="<?= strpos($_SERVER['QUERY_STRING'], 'page=sinhvien') !== false ? 'active' : '' ?>" href="?page=sinhvien&action=index">
                        <i class="fas fa-users"></i>Sinh viên
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="<?= strpos($_SERVER['QUERY_STRING'], 'page=hocphan') !== false ? 'active' : '' ?>" href="?page=hocphan&action=index">
                        <i class="fas fa-book"></i>Học phần
                    </a>
                </li>
                <li class="navbar-item">
                    <a class="<?= strpos($_SERVER['QUERY_STRING'], 'page=dangky') !== false ? 'active' : '' ?>" href="?page=dangky&action=list">
                        <i class="fas fa-edit"></i>Đăng ký HP
                    </a>
                </li>
            </ul>
            
            <ul class="navbar-menu user-menu">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                    <li class="navbar-item">
                        <a href="?page=auth&action=logout">
                            <i class="fas fa-sign-out-alt"></i>Đăng xuất (<?= $_SESSION['HoTen'] ?? $_SESSION['MaSV'] ?>)
                        </a>
                    </li>
                <?php else: ?>
                    <li class="navbar-item">
                        <a href="?page=auth&action=login">
                            <i class="fas fa-sign-in-alt"></i>Đăng nhập
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-4"> 