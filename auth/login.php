<?php
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
    echo "<script>alert('$error');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="../app/controllers/authController.php">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="login">Login</button>
</form>
<p>Don't have an account? <a href="register.php">Register</a></p>

    
</body>
</html>