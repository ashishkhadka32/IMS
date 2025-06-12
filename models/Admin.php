<?php
namespace App\Models;
use App\Core\Model;

class Admin extends Model {
    private $table = "admins";

    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Login successful'];
            header('Location: /ims/index.php');
            exit;
        } else {
            $_SESSION['msg'] = 'Invalid email or password';
            header('Location: ./auth/login.php');
            exit;
        }
    }

    public function register($name, $email, $password) {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $_SESSION['alert'] = ['type' => 'error', 'message' => 'Email already registered'];
            header('Location: ./auth/registration.php');
            exit;
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO " . $this->table . " (name, email, password) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sss", $name, $email, $hashedPassword);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
    }
}
?>