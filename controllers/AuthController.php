<?php
require_once './models/Admin.php';

class AuthController
{
    private $admin;

    public function __construct()
    {
        $this->admin = new Admin();
    }

    public function processLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->admin->login($email, $password);
        } else {
            $_SESSION['msg'] = 'Form not submitted properly.';
            header('Location: ./auth/login.php'); 
            exit;
        }
    }

    public function processRegistration()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->admin->register($name, $email, $password);

            if ($result) {
                $_SESSION['alert'] = ['type' => 'success', 'message' => 'Registration successful'];
                header('Location: ./auth/login.php');
                exit;
            } else {
                $_SESSION['msg'] = 'Registration failed';
                header('Location: ./auth/registration.php');
                exit;
            }
        } else {
            $_SESSION['msg'] = 'Form not submitted properly.';
            header('Location: ./auth/registration.php');
            exit;
        }
    }

    public function processLogout()
    {
        session_destroy();
        header('Location: ./auth/login.php');
        exit;
    }
}
