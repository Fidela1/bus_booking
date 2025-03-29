<?php
include_once __DIR__ . '/../../config/database.php';
include_once __DIR__ . '/../models/User.php';

session_start();

class AuthController {
    private $db;
    private $userModel;

    public function __construct() {
        global $conn; // Use the database connection from database.php
        $this->db = $conn;
        $this->userModel = new User($this->db); // Initialize User model properly
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
    
            $result = $this->userModel->register($username, $email, $password, $role);
    
            if ($result === true) {
                header("Location: ../../auth/login.php");
                exit();
            } else {
                echo "<script>alert('$result'); window.location.href = '../../auth/register.php';</script>";
            }
        }
    }
    
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $user = $this->userModel->login($username, $password);
    
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
    
                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: ../../admin/dashboard.php");
                } else {
                    header("Location: ../../user/dashboard.php");
                }
                exit();
            } else {
                // Redirect back to login with error message
                header("Location: ../../auth/login.php?error=Invalid email or password");
                exit();
                
            }
        }
    }
    

    public function logout() {
        session_destroy();
        header("Location: ../../auth/login.php");
    }
}

$authController = new AuthController();

if (isset($_POST['register'])) {
    $authController->register();
}

if (isset($_POST['login'])) {
    $authController->login();
}

if (isset($_GET['logout'])) {
    $authController->logout();
}
?>
  
   

   