<?php
require 'db_connect.php';
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0; foreach($cart as $item) $total += $item['price'] * $item['qty'];
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><title>Cart - Suntek Store</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css"></head><body>
<nav class="navbar navbar-dark bg-dark"><div class="container"><a class="navbar-brand" href="index.php">Suntek Store</a></div></nav>
<div class="container mt-3"><h2>Your Shopping Cart</h2>
<?php if(count($cart)==0): ?><p>Your cart is empty. <a href="products.php">Continue shopping</a></p>
<?php else: ?>
<form method="post" action="update_cart.php">
<table class="table"><thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead><tbody>
<?php foreach($cart as $i=>$item): ?>
<tr><td><?=htmlspecialchars($item['name'])?></td><td>$<?=number_format($item['price'],2)?></td>
<td><input type="number" name="qty[<?=$i?>]" value="<?=$item['qty']?>" min="1" class="form-control" style="width:80px"></td>
<td>$<?=number_format($item['price']*$item['qty'],2)?></td>
<td><a href="remove_from_cart.php?index=<?=$i?>" class="btn btn-sm btn-danger">Remove</a></td></tr>
<?php endforeach; ?>
</tbody></table>
<p class="fw-bold">Total: $<?=number_format($total,2)?></p>
<button class="btn btn-primary" type="submit">Update Cart</button>
<a class="btn btn-success" href="checkout.php">Proceed to Checkout</a></form><?php endif; ?>
</div><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script></body></html>