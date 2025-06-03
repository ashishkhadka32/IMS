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
    case 'create':
        $controller->create();
        break;
    case 'index':
        $controller->index();
        break;
    case 'update':
        $controller->update();
        break;
    case 'delete':
        $controller->delete();
        break;

    //Category.
    case 'categoryIndex':
        $categoryController->index();
        break;
    case 'categoryCreate':
        $categoryController->categoryCreate();
        break;
    case 'categoryUpdate':
        $categoryController->categoryUpdate();
        break;
    case 'categoryDelete':
        $categoryController->categoryDelete();
        break;
    default:
        $controller->index();
        break;
}
