<?php
require 'db_connect.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT id,name,price FROM products WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();
if(!$p){ header('Location: products.php'); exit; }
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$found=false;
foreach($cart as &$c){ if($c['id']==$p['id']){ $c['qty'] += 1; $found=true; break; } }
if(!$found) $cart[] = ['id'=>$p['id'],'name'=>$p['name'],'price'=>$p['price'],'qty'=>1];
$_SESSION['cart'] = $cart;
header('Location: cart.php'); exit;
?>