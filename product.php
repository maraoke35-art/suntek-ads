<?php
require 'db_connect.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();
if(!$p){ echo "Product not found"; exit; }
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><title><?=htmlspecialchars($p['name'])?> - Suntek Store</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css"></head><body>
<nav class="navbar navbar-dark bg-dark"><div class="container"><a class="navbar-brand" href="index.php">Suntek Store</a></div></nav>
<div class="container mt-3">
  <div class="row product-detail">
    <div class="col-md-5"><img src="<?=htmlspecialchars($p['image'])?>" class="img-fluid rounded" alt=""></div>
    <div class="col-md-7">
      <h2><?=htmlspecialchars($p['name'])?></h2>
      <p class="text-muted">$<?=number_format($p['price'],2)?></p>
      <p><?=nl2br(htmlspecialchars($p['description']))?></p>
      <a class="btn btn-success" href="add_to_cart.php?id=<?=$p['id']?>">Add to Cart</a>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body></html>