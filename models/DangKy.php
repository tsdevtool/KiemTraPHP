<?php
class DangKy {
    private $conn;
    private $table = "DangKy";

    public $MaDK;
    public $NgayDK;
    public $MaSV;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($maSV, $maHP) {
        // Begin transaction
        $this->conn->beginTransaction();
        
        try {
            // Check if course is still available
            $stmt = $this->conn->prepare("SELECT SoLuong FROM HocPhan WHERE MaHP = ? FOR UPDATE");
            $stmt->execute([$maHP]);
            $soLuong = $stmt->fetchColumn();
            
            if ($soLuong > 0) {
                // Check if student has already registered for this course
                $stmt = $this->conn->prepare("
                    SELECT COUNT(*) FROM DangKy dk 
                    JOIN ChiTietDangKy ct ON dk.MaDK = ct.MaDK 
                    WHERE dk.MaSV = ? AND ct.MaHP = ?
                ");
                $stmt->execute([$maSV, $maHP]);
                $alreadyRegistered = $stmt->fetchColumn();
                
                if ($alreadyRegistered > 0) {
                    $this->conn->rollBack();
                    return false; // Already registered
                }
                
                // Decrease available slots
                $stmt = $this->conn->prepare("UPDATE HocPhan SET SoLuong = SoLuong - 1 WHERE MaHP = ?");
                $stmt->execute([$maHP]);
        
                // Check if student already has a registration entry
                $stmt = $this->conn->prepare("SELECT MaDK FROM DangKy WHERE MaSV = ? ORDER BY MaDK DESC LIMIT 1");
                $stmt->execute([$maSV]);
                $existingDK = $stmt->fetch();
                
                if ($existingDK) {
                    // Use existing registration
                    $maDK = $existingDK['MaDK'];
                } else {
                    // Create new registration entry
                    $stmt = $this->conn->prepare("INSERT INTO DangKy (NgayDK, MaSV) VALUES (NOW(), ?)");
                    $stmt->execute([$maSV]);
                    $maDK = $this->conn->lastInsertId();
                }
                
                // Add course to registration details
                $stmt = $this->conn->prepare("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)");
                $result = $stmt->execute([$maDK, $maHP]);
                
                $this->conn->commit();
                return $result;
            }
            
            $this->conn->rollBack();
            return false;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function getRegisteredCourses($maSV) {
        $stmt = $this->conn->prepare("
            SELECT HP.MaHP, HP.TenHP, HP.SoTinChi 
            FROM DangKy DK
            JOIN ChiTietDangKy CT ON DK.MaDK = CT.MaDK
            JOIN HocPhan HP ON CT.MaHP = HP.MaHP
            WHERE DK.MaSV = ?
        ");
        $stmt->execute([$maSV]);
        return $stmt->fetchAll();
    }
}
