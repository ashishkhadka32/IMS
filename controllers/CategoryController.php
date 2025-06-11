<?php

require_once './models/Category.php';

class CategoryController {
    private $category;

    public function __construct() {
        $this->category = new Category();
    }

    public function index() {
        $categories = $this->category->getAllCategory();
        include './views/categories/index.php';
    }

    public function categoryCreate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            if (!empty($name)) {
                $this->category->create($name);
                $_SESSION['alert'] = ['type' => 'success', 'message' => 'Category created successfully'];
                header('Location: ?action=category/index');
                exit;
            } else {
                $_SESSION['alert'] = ['type' => 'error', 'message' => 'Category name is required'];
            }
        } else {
            
            include './views/categories/create.php';
        }
    }

    public function categoryUpdate() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? (int)$_POST['id'] : $id;
            $name = $_POST['name'] ?? '';

            if (!empty($name)) {
                if ($this->category->update($id, $name)) {
                    $_SESSION['alert'] = ['type' => 'success', 'message' => 'Category updated successfully'];
                    header('Location: ?action=category/index');
                    exit;
                } else {
                    $_SESSION['alert'] = ['type' => 'error', 'message' => 'Category update failed'];
                }
            } else {
                $_SESSION['alert'] = ['type' => 'error', 'message' => 'Category name is required'];
            }
        } else {
            $category = $this->category->readOne($id);
            if ($category) {
                include './views/categories/edit.php';
            } else {
                $_SESSION['alert'] = ['type' => 'error', 'message' => 'Category not found'];
                header('Location: ?action=category/index');
                exit;
            }
        }
    }

    public function categoryDelete() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
        if ($this->category->delete($id)) {
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Category deleted successfully'];
        } else {
            $_SESSION['alert'] = ['type' => 'error', 'message' => 'Category deletion failed'];
        }
        header('Location: ?action=category/index');
        exit;
    }
}