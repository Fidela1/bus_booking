<?php
class User {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $email, $password, $role) {
        // Check if email or username already exists
        $checkQuery = "SELECT * FROM users WHERE email = ? OR name = ?";
        $stmtCheck = $this->conn->prepare($checkQuery);
        
        if (!$stmtCheck) {
            die("SQL Error: " . $this->conn->error);
        }
    
        $stmtCheck->bind_param("ss", $email, $username);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();
    
        if ($result->num_rows > 0) {
            return "User already exists! Try a different email or username.";
        }
    
        // Proceed with registration if no duplicates found
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }
    
        $stmt->bind_param("ssss", $username, $email, $passwordHash, $role);
    
        if (!$stmt->execute()) {
            die("Execution Error: " . $stmt->error);
        }
    
        return true; // Registration successful
    }
    


    public function login($name, $password) {
        $query = "SELECT * FROM users WHERE name = ?";
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            die("SQL Error: " . $this->conn->error);
        }
    
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
    
            // Verify password
            if (password_verify($password, $user['password'])) {
                return $user; // Return user data on successful login
            }
        }
        
        return false; // Invalid credentials
    }
    
}
?>
