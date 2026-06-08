<?php
class KantinModel {
    private $db;

    public function __construct($db) { $this->db = $db; }

    public function getAllKantin() {
        return $this->db->query("SELECT * FROM kantin WHERE Status_Buka = 1")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchKantin($keyword) {
        $stmt = $this->db->prepare("SELECT * FROM kantin WHERE Nama_Kantin LIKE ? AND Status_Buka = 1");
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKantinById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kantin WHERE ID_Kantin = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getKantinByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM kantin WHERE ID_User = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalRevenue($idKantin) {
        $stmt = $this->db->prepare("SELECT SUM(Total_Bayar) as total FROM transaksi WHERE ID_Kantin = ? AND Status_Pesanan = 'Selesai'");
        $stmt->execute([$idKantin]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    public function toggleStatusKantin($id) {
        $dKantin = $this->db->query("SELECT * FROM kantin WHERE ID_Kantin = $id")->fetch(PDO::FETCH_ASSOC);

        if($dKantin) {
            $stmt = $this->db->prepare("UPDATE kantin SET Status_Buka=? WHERE ID_Kantin=?");
            return $stmt->execute([$dKantin["Status_Buka"] == 1 ? 0 : 1, $id]);
        }
        return NULL;
    }

    public function getAllKantinAdmin() {
        return $this->db->query("SELECT k.*, u.Nama_User FROM kantin k LEFT JOIN users u ON k.ID_User = u.ID_User")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createKantin($nama, $telp, $idUser, $status, $kantinurl) {
        $stmt = $this->db->prepare("INSERT INTO kantin (Nama_Kantin, Telp_Kantin, ID_User, Status_Buka, Kantin_url) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nama, $telp, $idUser, $status, $kantinurl]);
    }

    public function updateKantin($id, $nama, $telp, $status) {
        $stmt = $this->db->prepare("UPDATE kantin SET Nama_Kantin=?, Telp_Kantin=?, Status_Buka=? WHERE ID_Kantin=?");
        return $stmt->execute([$nama, $telp, $status, $id]);
    }
    public function deleteKantin($id) {
        $stmt = $this->db->prepare("DELETE FROM kantin WHERE ID_Kantin = ?");
        return $stmt->execute([$id]);
    }
}