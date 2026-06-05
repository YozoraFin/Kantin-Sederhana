<?php
class CartModel {
    private $db;

    public function __construct($db) { $this->db = $db; }

    public function getOrCreateCart($idUser, $idKantin) {
        $stmt = $this->db->prepare("SELECT * FROM keranjang WHERE ID_User = ? AND ID_Kantin = ?");
        $stmt->execute([$idUser, $idKantin]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cart) {
            $stmt = $this->db->prepare("INSERT INTO keranjang (ID_User, ID_Kantin, Waktu_Dibuat, Total_Harga) VALUES (?, ?, NOW(), 0)");
            $stmt->execute([$idUser, $idKantin]);
            return $this->db->lastInsertId();
        }
        return $cart['ID_Keranjang'];
    }

    public function getCartContent($idUser) {
        $stmt = $this->db->prepare("SELECT dk.*, p.Nama_Produk, p.Harga_Produk, k.Nama_Kantin, k.ID_Kantin FROM detail_keranjang dk 
                                    JOIN keranjang kr ON dk.ID_Keranjang = kr.ID_Keranjang 
                                    JOIN produk p ON dk.ID_Produk = p.ID_Produk 
                                    JOIN kantin k ON kr.ID_Kantin = k.ID_Kantin WHERE kr.ID_User = ?");
        $stmt->execute([$idUser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToCart($idCart, $idProduk, $harga) {
        $stmt = $this->db->prepare("SELECT * FROM detail_keranjang WHERE ID_Keranjang = ? AND ID_Produk = ?");
        $stmt->execute([$idCart, $idProduk]);
        $detail = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($detail) {
            $jumlahBaru = $detail['Jumlah'] + 1;
            $subtotalBaru = $jumlahBaru * $harga;
            $stmt = $this->db->prepare("UPDATE detail_keranjang SET Jumlah = ?, Subtotal = ? WHERE ID_Detail_Keranjang = ?");
            $stmt->execute([$jumlahBaru, $subtotalBaru, $detail['ID_Detail_Keranjang']]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO detail_keranjang (ID_Keranjang, ID_Produk, Jumlah, Subtotal) VALUES (?, ?, 1, ?)");
            $stmt->execute([$idCart, $idProduk, $harga]);
        }
        $this->updateTotalHargaKeranjang($idCart);
    }

    public function deleteItem($idDetail) {
        $stmt = $this->db->prepare("SELECT ID_Keranjang FROM detail_keranjang WHERE ID_Detail_Keranjang = ?");
        $stmt->execute([$idDetail]);
        $idCart = $stmt->fetch(PDO::FETCH_ASSOC)['ID_Keranjang'];

        $stmt = $this->db->prepare("DELETE FROM detail_keranjang WHERE ID_Detail_Keranjang = ?");
        $stmt->execute([$idDetail]);
        
        $this->updateTotalHargaKeranjang($idCart);
    }

    private function updateTotalHargaKeranjang($idCart) {
        $stmt = $this->db->prepare("UPDATE keranjang SET Total_Harga = (SELECT IFNULL(SUM(Subtotal),0) FROM detail_keranjang WHERE ID_Keranjang = ?) WHERE ID_Keranjang = ?");
        $stmt->execute([$idCart, $idCart]);
    }

    public function clearCart($idCart) {
        $this->db->prepare("DELETE FROM detail_keranjang WHERE ID_Keranjang = ?")->execute([$idCart]);
        $this->db->prepare("DELETE FROM keranjang WHERE ID_Keranjang = ?")->execute([$idCart]);
    }
}