<?php
require 'db_connect.php';
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['qty'])){
    $qtys = $_POST['qty'];
    foreach($qtys as $i=>$q){ if(isset($_SESSION['cart'][$i])) $_SESSION['cart'][$i]['qty'] = max(1,(int)$q); }
}
header('Location: cart.php'); exit;
?>