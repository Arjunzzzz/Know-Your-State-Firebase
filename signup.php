<?php
$servername = "localhost";
$username = "root"; 
$password = "";   
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Signup successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body style="background-image: url('images/signup.png'); background-size: cover; background-position: center; margin: 0; padding: 0; height: 100vh; display: flex; justify-content: center; align-items: center; font-family: Arial, sans-serif; color: #f0e6a1;">
    <form method="post" action="" style="background-color: rgba(0, 0, 0, 0.7); padding: 20px; border-radius: 8px; width: 300px; text-align: center;">
        <label for="username" style="color: #f0e6a1; display: block; margin-bottom: 8px;">Username:</label>
        <input type="text" name="username" required style="padding: 8px; margin: 5px 0 15px 0; border: 1px solid #ccc; border-radius: 4px; width: calc(100% - 16px);"><br><br>
        <label for="password" style="color: #f0e6a1; display: block; margin-bottom: 8px;">Password:</label>
        <input type="password" name="password" required style="padding: 8px; margin: 5px 0 15px 0; border: 1px solid #ccc; border-radius: 4px; width: calc(100% - 16px);"><br><br>
        <input type="submit" value="Sign Up" style="padding: 10px; border: none; border-radius: 4px; background-color: #4CAF50; color: white; cursor: pointer; width: 100%;"><br><br>
        <a href="index.php" style="color: #e6f0ff; text-decoration: none; display: block; margin-top: 10px;">Login</a>
    </form>
</body>
</html>
