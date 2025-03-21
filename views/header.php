<?php
// Nếu session chưa được bắt đầu thì bắt đầu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="?page=sinhvien&action=index">Quản lý học phần</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?page=sinhvien&action=index">Sinh viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=hocphan&action=index">Học phần</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=dangky&action=list">Đăng ký học phần</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                    <li class="nav-item">
                        <span class="nav-link">Xin chào, <?= $_SESSION['HoTen'] ?? $_SESSION['MaSV'] ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=auth&action=logout">Đăng xuất</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=auth&action=login">Đăng nhập</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav> 