<?php
require '../db_connect.php';
if(!isset($_SESSION['admin'])){ header('Location: admin_login.php'); exit; }
$id = isset($_GET['id'])?(int)$_GET['id']:0;
$stmt = $pdo->prepare("SELECT image FROM products WHERE id=?"); $stmt->execute([$id]); $img = $stmt->fetchColumn();
$stmt = $pdo->prepare("DELETE FROM products WHERE id=?"); $stmt->execute([$id]);
if($img && file_exists('../'.$img)) @unlink('../'.$img);
header('Location: admin_dashboard.php'); exit;
?>