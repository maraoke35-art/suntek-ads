<?php
require 'db_connect.php';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$search = isset($_GET['q']) ? $_GET['q'] : '';
$params = [];
$sql = "SELECT * FROM products WHERE 1=1";
if($category){
    $sql .= " AND category = ?";
    $params[] = $category;
}
if($search){
    $sql .= " AND (name LIKE ? OR description LIKE ?)";
    $params[] = "%$search%"; $params[] = "%$search%";
}
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
$cats = $pdo->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
?> 
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><title>Products - Suntek Store</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head><body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container"><a class="navbar-brand" href="index.php">Suntek Store</a></div>
</nav>
<div class="container mt-3">
  <div class="row">
    <div class="col-md-3">
      <div class="card"><div class="card-body">
        <h5>Categories</h5><ul class="list-unstyled">
        <li><a href="products.php">All</a></li>
        <?php foreach($cats as $c): ?><li><a href="products.php?category=<?=urlencode($c)?>"><?=htmlspecialchars($c)?></a></li><?php endforeach; ?>
        </ul>
      </div></div>
    </div>
    <div class="col-md-9">
      <form class="d-flex mb-3" method="get"><input class="form-control me-2" name="q" placeholder="Search" value="<?=htmlspecialchars($search)?>"><button class="btn btn-outline-primary">Search</button></form>
      <div class="row">
        <?php foreach($products as $p): ?>
          <div class="col-md-4 mb-3"><div class="card h-100">
            <img src="<?=htmlspecialchars($p['image'])?>" class="card-img-top" alt="<?=htmlspecialchars($p['name'])?>">
            <div class="card-body"><h5><?=htmlspecialchars($p['name'])?></h5><p class="text-muted">$<?=number_format($p['price'],2)?></p>
            <p><?=htmlspecialchars(substr($p['description'],0,100))?>...</p>
            <a class="btn btn-sm btn-primary" href="product.php?id=<?=$p['id']?>">View</a>
            <a class="btn btn-sm btn-success" href="add_to_cart.php?id=<?=$p['id']?>">Add to Cart</a></div></div></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body></html>