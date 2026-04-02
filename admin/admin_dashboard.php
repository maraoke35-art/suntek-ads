<?php
require '../db_connect.php';
if(!isset($_SESSION['admin'])){ header('Location: admin_login.php'); exit; }
$products_count = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$users_count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$orders_count = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$recent_orders = $pdo->query("SELECT * FROM orders ORDER BY order_date DESC LIMIT 5")->fetchAll();
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"><div class="container"><a class="navbar-brand" href="admin_dashboard.php">Admin - Suntek</a>
<ul class="navbar-nav ms-auto"><li class="nav-item"><a class="nav-link" href="add_product.php">Add Product</a></li><li class="nav-item"><a class="nav-link" href="manage_orders.php">Orders</a></li><li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li></ul></div></nav>
<div class="container mt-4">
  <div class="row">
    <div class="col-md-4"><div class="card p-3"><h5>Products</h5><p class="display-6"><?=$products_count?></p></div></div>
    <div class="col-md-4"><div class="card p-3"><h5>Users</h5><p class="display-6"><?=$users_count?></p></div></div>
    <div class="col-md-4"><div class="card p-3"><h5>Orders</h5><p class="display-6"><?=$orders_count?></p></div></div>
  </div>
  <div class="mt-4"><h5>Recent Orders</h5><table class="table"><thead><tr><th>ID</th><th>User</th><th>Total</th><th>Date</th></tr></thead><tbody>
  <?php foreach($recent_orders as $o): $u = $pdo->prepare('SELECT name FROM users WHERE id=?'); $u->execute([$o['user_id']]); $un = $u->fetchColumn(); ?>
    <tr><td><?=$o['id']?></td><td><?=htmlspecialchars($un)?></td><td>$<?=number_format($o['total_amount'],2)?></td><td><?=$o['order_date']?></td></tr>
  <?php endforeach; ?>
  </tbody></table></div>
</div></body></html>