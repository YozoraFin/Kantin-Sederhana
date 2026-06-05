<?php
class ProductModel {
    private $db;

    public function __construct($db) { $this->db = $db; }

    public function getMenuByKantin($idKantin) {
        $stmt = $this->db->prepare("SELECT p.*, k.Nama_Kategori FROM produk p JOIN kategori k ON p.ID_Kategori = k.ID_Kategori WHERE p.ID_Kantin = ?");
        $stmt->execute([$idKantin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT * FROM produk WHERE ID_Produk = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct($nama, $harga, $idKategori, $idKantin, $deskripsi) {
        $stmt = $this->db->prepare("INSERT INTO produk (Nama_Produk, Harga_Produk, ID_Kategori, ID_Kantin, Deskripsi_Produk) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nama, $harga, $idKategori, $idKantin, $deskripsi]);
    }
    public function updateProduct($id, $nama, $harga, $idKategori, $deskripsi) {
        $stmt = $this->db->prepare("UPDATE produk SET Nama_Produk=?, Harga_Produk=?, ID_Kategori=?, Deskripsi_Produk=? WHERE ID_Produk=?");
        return $stmt->execute([$nama, $harga, $idKategori, $deskripsi, $id]);
    }
    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM produk WHERE ID_Produk = ?");
        return $stmt->execute([$id]);
    }
}