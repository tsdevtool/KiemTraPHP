<?php
require_once "../../config/Database.php";
require_once "../../models/Auth.php";

$db = (new Database())->getConnection();
$auth = new Auth($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST['MaSV'];
    if ($auth->login($maSV)) {
        header("Location: ../../public/index.php");
    } else {
        $error = "Mã sinh viên không hợp lệ!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/assets/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Đăng nhập</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                    <form method="POST" action="?page=auth&action=login">
                        <div class="form-group">
                            <label>Mã Sinh Viên:</label>
                            <input type="text" name="MaSV" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
