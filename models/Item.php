<?php
require_once './core/Model.php';
class Item extends Model
{
    private $table = 'items';

    public function create($name, $quantity, $price, $category_id, $file)
    {
        $stmt = $this->db->prepare("INSERT INTO items (name, quantity, price, category_id, file) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sidis", $name, $quantity, $price, $category_id, $file);
        $result =  $stmt->execute();
        return $result;
    }
    public function read()
    {
        $query = "
        SELECT items.*, categories.name AS category
        FROM items
        LEFT JOIN categories ON items.category_id = categories.id
    ";
        $result = $this->db->query($query);

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        return $items;
    }

    public function readOne($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public function update($id, $name, $quantity, $price, $category_id, $file = null)
    {
        if ($file !== null) {
            $stmt = $this->db->prepare("UPDATE items SET name = ?, quantity = ?, price = ?, category_id = ?, file = ? WHERE id = ?");
            $stmt->bind_param("sidisi", $name, $quantity, $price, $category_id, $file, $id);
        } else {
            $stmt = $this->db->prepare("UPDATE items SET name = ?, quantity = ?, price = ?, category_id = ? WHERE id = ?");
            $stmt->bind_param("sidii", $name, $quantity, $price, $category_id, $id);
        }

        return $stmt->execute();
    }



    public function delete($id)
    {
        $id = (int)$this->db->real_escape_string($id);
        $sql = "SELECT `file` FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $row = $result->fetch_assoc()) {
            $filepath = $row['file'];

            if (!empty($filepath) && file_exists($filepath)) {
                unlink($filepath);
            } else {
                echo "File not found";
            }
        }

        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getByCategory($category_id)
    {
        $query = "
        SELECT items.*, categories.name AS category
        FROM items
        LEFT JOIN categories ON items.category_id = categories.id
        WHERE category_id = ?
    ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        return $items;
    }
}
