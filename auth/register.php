<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<form action="../app/controllers/authcontroller.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="role">Select Role:</label>
    <select name="role" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit" name="register">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>

</body>
</html>