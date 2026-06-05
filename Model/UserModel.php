<?php
class UserModel {
    private $db;

    public function __construct($db) { $this->db = $db; }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE Email_User = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; 
        }
        
        return false;
    }

    public function updatePassword($id, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE ID_User = ?");
        return $stmt->execute([$hashedPassword, $id]);
    }

    public function getAllUsers() {
        return $this->db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createUser($nama, $email, $password, $alamat, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (Nama_User, Email_User, password, Alamat_User, Role_User) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nama, $email, $hashedPassword, $alamat, $role]);
    }
    public function updateUser($id, $nama, $email, $alamat, $role) {
        $stmt = $this->db->prepare("UPDATE users SET Nama_User=?, Email_User=?, Alamat_User=?, Role_User=? WHERE ID_User=?");
        return $stmt->execute([$nama, $email, $alamat, $role, $id]);
    }
    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE ID_User = ?");
        return $stmt->execute([$id]);
    }
}