<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO user ( user_name, email, password, user_level) VALUES (?, ?, ? , 1)");
    $stmt->execute([$name, $email, $hashed_password]);

    header("Location: index.php"); // Redirect to homepage
    exit;
}
?>
