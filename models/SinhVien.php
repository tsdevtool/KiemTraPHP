<?php
class SinhVien {
    private $conn;
    private $table = "SinhVien";

    public $MaSV;
    public $HoTen;
    public $GioiTinh;
    public $NgaySinh;
    public $Hinh;
    public $MaNganh;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($maSV) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE MaSV = ?");
        $stmt->execute([$maSV]);
        return $stmt->fetch();
    }

    public function create() {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$this->MaSV, $this->HoTen, $this->GioiTinh, $this->NgaySinh, $this->Hinh, $this->MaNganh]);
    }

    public function update($maSV) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? WHERE MaSV = ?");
        return $stmt->execute([$this->HoTen, $this->GioiTinh, $this->NgaySinh, $this->Hinh, $this->MaNganh, $maSV]);
    }

    public function delete($maSV) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE MaSV = ?");
        return $stmt->execute([$maSV]);
    }
}
