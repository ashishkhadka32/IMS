<?php
class Category extends Model {
    private $table = 'categories';

    public function create($data) {
        $stmt = $this->db->prepare('INSERT INTO ' . $this->table . ' (name) VALUES (?)');
        $stmt->bind_param('s', $data['name']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public function update($id, $name) {
        $stmt = $this->db->prepare("UPDATE " . $this->table . " SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}