<?php
require '../db_connect.php';
if(!isset($_SESSION['admin'])){ header('Location: admin_login.php'); exit; }
$orders = $pdo->query("SELECT * FROM orders ORDER BY order_date DESC")->fetchAll();
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><title>Manage Orders</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<nav class="navbar navbar-dark bg-dark"><div class="container"><a class="navbar-brand" href="admin_dashboard.php">Admin</a></div></nav>
<div class="container mt-3"><h3>Orders</h3><table class="table"><thead><tr><th>ID</th><th>User</th><th>Total</th><th>Address</th><th>Date</th></tr></thead><tbody>
<?php foreach($orders as $o): $u = $pdo->prepare('SELECT name FROM users WHERE id=?'); $u->execute([$o['user_id']]); $un = $u->fetchColumn(); ?>
<tr><td><?=$o['id']?></td><td><?=htmlspecialchars($un)?></td><td>$<?=number_format($o['total_amount'],2)?></td><td><?=htmlspecialchars($o['shipping_address'])?></td><td><?=$o['order_date']?></td></tr>
<?php endforeach; ?>
</tbody></table></div></body></html>