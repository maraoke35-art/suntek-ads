<?php
require 'db_connect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = trim($_POST['name']); $email = trim($_POST['email']); $password = $_POST['password'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ die('Invalid email'); }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
    try{ $stmt->execute([$name,$email,$hash]); header('Location: login.php'); } catch (Exception $e){ die('Registration failed: '.$e->getMessage()); }
}
?>