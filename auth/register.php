<?php
include("../config/database.php");
include("../includes/header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (firstname, lastname, username, email, telephone, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $firstname, $lastname, $username, $email, $telephone, $password);

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<form method="post" class="max-w-md mx-auto bg-gray-800 p-8 rounded-xl shadow-lg mt-10">
    <h2 class="text-2xl font-bold text-white mb-6 text-center">Register</h2>
    
    <input 
        type="text" 
        name="firstname" 
        placeholder="Firstname" 
        required
        class="w-full p-3 mb-4 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
    
    <input 
        type="text" 
        name="lastname" 
        placeholder="Lastname" 
        required
        class="w-full p-3 mb-4 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
    
    <input 
        type="text" 
        name="username" 
        placeholder="Username" 
        required
        class="w-full p-3 mb-4 rounded-lg border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
    
    <input 
        type="email" 
        name="email" 
        placeholder="Email" 
        required
        class="w-full p-3 mb-4 rounded-lg border border-gray-600 bg-gray-700 text-white placeholde"
       >
         <input 
        type="telephone" 
        name="telephone" 
        placeholder="Telephone" 
        required
        class="w-full p-3 mb-4 rounded-lg border border-gray-600 bg-gray-700 text-white placeholde"
       >
         <input 
        type="password" 
        name="password" 
        placeholder="Password" 
        required
        class="w-full p-3 mb-4 rounded-lg border border-gray-600 bg-gray-700 text-white placeholde"
       >
       <button type="submit"
        class="w-full p-3 mb-4 rounded-lg  border border-blue-800 bg-blue-900 text-white placeholde hover:bg-blue-800"
       >Register</button>

</form>
