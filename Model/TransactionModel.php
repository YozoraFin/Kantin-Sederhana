<?php
class TransactionModel {
    private $db;

    public function __construct($db) { $this->db = $db; }

    public function checkout($idUser, $idKantin, $catatan) {
        // 1. Ambil data keranjang asal
        $stmt = $this->db->prepare("SELECT * FROM keranjang WHERE ID_User = ? AND ID_Kantin = ?");
        $stmt->execute([$idUser, $idKantin]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$cart) return false;

        // 2. Pindahkan ke induk transaksi
        $stmt = $this->db->prepare("INSERT INTO transaksi (ID_User, ID_Kantin, Waktu_Transaksi, Total_Bayar, catatan, Status_Pesanan) VALUES (?, ?, NOW(), ?, ?, 'Proses')");
        $stmt->execute([$idUser, $idKantin, $cart['Total_Harga'], $catatan]);
        $idTrx = $this->db->lastInsertId();

        // 3. Pindahkan item detail_keranjang ke detail_transaksi
        $stmt = $this->db->prepare("SELECT * FROM detail_keranjang WHERE ID_Keranjang = ?");
        $stmt->execute([$cart['ID_Keranjang']]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($items as $item) {
            $ins = $this->db->prepare("INSERT INTO detail_transaksi (ID_Transaksi, ID_Produk, Jumlah, Subtotal) VALUES (?, ?, ?, ?)");
            $ins->execute([$idTrx, $item['ID_Produk'], $item['Jumlah'], $item['Subtotal']]);
        }
        return $cart['ID_Keranjang'];   
    }

    public function getOrdersByPembeli($idUser, $isOngoing = true) {
        $statusCondition = $isOngoing ? "IN ('Proses', 'Siap')" : "IN ('Selesai', 'Ditolak')";
        $stmt = $this->db->prepare("SELECT t.*, k.Nama_Kantin FROM transaksi t JOIN kantin k ON t.ID_Kantin = k.ID_Kantin WHERE t.ID_User = ? AND t.Status_Pesanan $statusCondition ORDER BY t.Waktu_Transaksi DESC");
        $stmt->execute([$idUser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrdersByPenjual($idKantin, $status = 'Proses') {
        $stmt = $this->db->prepare("SELECT t.*, u.Nama_User FROM transaksi t JOIN users u ON t.ID_User = u.ID_User WHERE t.ID_Kantin = ? AND t.Status_Pesanan = ? ORDER BY t.Waktu_Transaksi ASC");
        $stmt->execute([$idKantin, $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTransactionDetail($idTrx) {
        $stmt = $this->db->prepare("SELECT dt.*, p.Nama_Produk, p.Harga_Produk FROM detail_transaksi dt JOIN produk p ON dt.ID_Produk = p.ID_Produk WHERE dt.ID_Transaksi = ?");
        $stmt->execute([$idTrx]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($idTrx, $status) {
        $stmt = $this->db->prepare("UPDATE transaksi SET Status_Pesanan = ? WHERE ID_Transaksi = ?");
        return $stmt->execute([$status, $idTrx]);
    }

    public function getAllTransactionsAdmin() {
        return $this->db->query("SELECT t.*, u.Nama_User, k.Nama_Kantin FROM transaksi t JOIN users u ON t.ID_User = u.ID_User JOIN kantin k ON t.ID_Kantin = k.ID_Kantin")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteTransaction($id) {
        $this->db->prepare("DELETE FROM detail_transaksi WHERE ID_Transaksi = ?")->execute([$id]);
        return $this->db->prepare("DELETE FROM transaksi WHERE ID_Transaksi = ?")->execute([$id]);
    }
}