<?php
// Session is already started in init.php, no need to start it again here

class Auth {
    private $conn;
    private $table = "SinhVien";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($maSV) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE MaSV = ?");
        $stmt->execute([$maSV]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['loggedin'] = true;
            $_SESSION['MaSV'] = $user['MaSV'];
            $_SESSION['HoTen'] = $user['HoTen'];
            
            // Kiểm tra nếu đây là tài khoản admin
            // Trong thực tế, hãy sử dụng một cột trong database để lưu role
            if ($maSV === 'admin') {
                $_SESSION['is_admin'] = true;
            }
            
            return true;
        }
        return false;
    }
    
    public function loginAdmin($username, $password) {
        // Trong ứng dụng thực tế, bạn nên kiểm tra thông tin đăng nhập
        // từ bảng Admin hoặc Users với mật khẩu được mã hóa
        if ($username === 'admin' && $password === 'admin123') {
            $_SESSION['loggedin'] = true;
            $_SESSION['is_admin'] = true;
            $_SESSION['HoTen'] = 'Quản trị viên';
            return true;
        }
        return false;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ?page=auth&action=login");
        exit;
    }

    public function isLoggedIn() {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }
    
    public function isAdmin() {
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
    }
}
