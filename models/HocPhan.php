<?php
class HocPhan {
    private $conn;
    private $table = "HocPhan";

    public $MaHP;
    public $TenHP;
    public $SoTinChi;
    public $SoLuong;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($maHP) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE MaHP = ?");
        $stmt->execute([$maHP]);
        return $stmt->fetch();
    }

    public function create() {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (MaHP, TenHP, SoTinChi, SoLuong) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$this->MaHP, $this->TenHP, $this->SoTinChi, $this->SoLuong]);
    }

    public function update($maHP) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET TenHP = ?, SoTinChi = ?, SoLuong = ? WHERE MaHP = ?");
        return $stmt->execute([$this->TenHP, $this->SoTinChi, $this->SoLuong, $maHP]);
    }

    public function delete($maHP) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE MaHP = ?");
        return $stmt->execute([$maHP]);
    }
}
