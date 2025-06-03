<?php
session_start();
require_once 'core/Model.php';
require_once 'controllers/ItemController.php';
require_once 'controllers/CategoryController.php';
require_once 'models/Item.php';
require_once 'models/Category.php';

$controller = new ItemController;
$categoryController = new CategoryController; 
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'items/create':
        $controller->create();
        break;
    case 'index':
        $controller->index();
        break;
    case 'items/update':
        $controller->update();
        break;
    case 'items/delete':
        $controller->delete();
        break;

    //Category.
    case 'category/index':
        $categoryController->index();
        break;
    case 'category/create':
        $categoryController->categoryCreate();
        break;
    case 'category/update':
        $categoryController->categoryUpdate();
        break;
    case 'category/delete':
        $categoryController->categoryDelete();
        break;
    default:
        $controller->index();
        break;
}
