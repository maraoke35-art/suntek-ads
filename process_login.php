<?php
require 'db_connect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = trim($_POST['email']); $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT id,name,email,password FROM users WHERE email = ?"); $stmt->execute([$email]); $user = $stmt->fetch();
    if($user && password_verify($password, $user['password'])){ $_SESSION['user'] = ['id'=>$user['id'],'name'=>$user['name'],'email'=>$user['email']]; header('Location: index.php'); exit; } else { echo "Login failed. <a href='login.php'>Try again</a>"; }
}
?>