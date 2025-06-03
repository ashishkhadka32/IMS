<?php

class itemController
{
    private $item;

    public function __construct()
    {
        $this->item = new Item();
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $category_id = $_POST['category'];

            $file = $_FILES['file'];
            $filename = $file['name'];
            $filepath = $file['tmp_name'];
            $fileerror = $file['error'];

            $file_extension = explode('.', $file['name']);
            $file_extension_check = strtolower(end($file_extension));
            $valid_file_extensions = array('jpg', 'jpeg', 'png', 'gif');

            if ($fileerror === 0) {
                if (in_array($file_extension_check, $valid_file_extensions)) {
                    $newfile = time() . '_' . basename($filename);
                    $destfile = 'uploads/' . $newfile;
                    if (move_uploaded_file($filepath, $destfile)) {
                        $this->item->create($name, $quantity, $price, $category_id, $destfile);
                        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Item created successfully'];
                        header('Location: index.php');
                    } else {
                        echo "Error uploading file";
                        return;
                    }
                } else {
                    $_SESSION['alert'] = ['type' => 'error', 'message' => 'Invalid file type. Please upload a JPEG, PNG, or GIF file.'];
                    header('Location: ?action=create');
                }
            }
        } else {
            $categoryController = new CategoryController;
            $categories = $categoryController->getAllCategory();

            include 'views/items/create.php';
        }
    }


  public function index()
{
    $categoryController = new CategoryController;
    $categories = $categoryController->getAllCategory();

    $categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

    if ($categoryId) {
        $items = $this->item->getByCategory($categoryId);
    } else {
        $items = $this->item->read();
    }

    include 'views/items/index.php';
}


    public function update()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? (int)$_POST['id'] : $id;
            $name = $_POST['name'] ?? '';
            $quantity = $_POST['quantity'] ?? 0;
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category'] ?? 0;

            // get old image if the new image is not uploaded
            $existingItem = $this->item->readOne($id);
            $destfile = $existingItem['file'] ?? null;

            // if new file is uploaded
            $file = $_FILES['file'];
            $filename = $file['name'];
            $filepath = $file['tmp_name'];
            $fileerror = $file['error'];

            if ($fileerror === 0 && !empty($filename)) {
                $file_extension = explode('.', $filename);
                $file_extension_check = strtolower(end($file_extension));
                $valid_file_extensions = array('jpg', 'jpeg', 'png', 'gif');

                if (in_array($file_extension_check, $valid_file_extensions)) {
                    $newfile = time() . '_' . basename($filename);
                    $destfile = 'uploads/' . $newfile;

                    if (move_uploaded_file($filepath, $destfile)) {
                        // Delete old image if exists
                        if (!empty($existingItem['file']) && file_exists($existingItem['file'])) {
                            unlink($existingItem['file']);
                        }
                    } else {
                        echo "Error uploading file";
                        return;
                    }
                } else {
                    $_SESSION['alert'] = ['type' => 'error', 'message' => 'Invalid file extension'];
                    header("Location: ?action=update&id=" . $id);
                    exit;
                }
            }

            if ($this->item->update($id, $name, $quantity, $price, $category_id, $destfile)) {
                $_SESSION['alert'] = ['type' => 'success', 'message' => 'Item updated successfully'];
                header("Location: index.php");
                exit;
            } else {
                echo "Update failed.";
            }
        } else {
            $item = $this->item->readOne($id);

            $categoryController = new CategoryController;
            $categories = $categoryController->getAllCategory();

            include 'views/items/edit.php';
        }
    }

    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($this->item->delete($id)) {
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Item deleted successfully'];
            header("Location: index.php");
            exit;
        }
    }
}
