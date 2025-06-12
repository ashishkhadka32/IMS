<?php 
namespace App\Controllers\api;

use App\Models\Item;
use App\Models\Category;


class ItemController{
    public function apiIndex()
{
    header('Content-Type: application/json');
    
    $categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
    $items = $categoryId ? $this->item->getByCategory($categoryId) : $this->item->read();
    
    http_response_code(200);
    echo json_encode($items);
}

public function apiCreate()
{
    header('Content-Type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        if (strpos($contentType, 'application/json') !== false) {
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data['name'] ?? '';
            $quantity = $data['quantity'] ?? 0;
            $price = $data['price'] ?? 0;
            $category_id = $data['category'] ?? 0;
        } else {
            $name = $_POST['name'] ?? '';
            $quantity = $_POST['quantity'] ?? 0;
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category'] ?? 0;
        }
        
        $destfile = '';
        if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            $file = $_FILES['file'];
            $filename = $file['name'];
            $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($file_extension, $valid_extensions)) {
                $newfile = time() . '_' . basename($filename);
                $destfile = 'Uploads/' . $newfile;
                if (!move_uploaded_file($file['tmp_name'], $destfile)) {
                    http_response_code(500);
                    echo json_encode(['error' => 'Failed to upload file']);
                    return;
                }
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid file type']);
                return;
            }
        }
        
        if ($name && $quantity && $price && $category_id) {
            $this->item->create($name, $quantity, $price, $category_id, $destfile);
            http_response_code(201);
            echo json_encode(['message' => 'Item created successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
        }
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
}

public function apiUpdate()
{
    header('Content-Type: application/json');
    
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'] ?? '';
        $quantity = $data['quantity'] ?? 0;
        $price = $data['price'] ?? 0;
        $category_id = $data['category'] ?? 0;
        
        $existingItem = $this->item->readOne($id);
        if (!$existingItem) {
            http_response_code(404);
            echo json_encode(['error' => 'Item not found']);
            return;
        }
        $destfile = $existingItem['file'] ?? null;
        
        // Note: File uploads are not typically sent in PUT; handle separately if needed
        
        if ($this->item->update($id, $name, $quantity, $price, $category_id, $destfile)) {
            http_response_code(200);
            echo json_encode(['message' => 'Item updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to update item']);
        }
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
}

public function apiDelete()
{
    header('Content-Type: application/json');
    
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $id) {
        if ($this->item->delete($id)) {
            http_response_code(200);
            echo json_encode(['message' => 'Item deleted successfully']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Item not found']);
        }
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed or invalid ID']);
    }
}
}