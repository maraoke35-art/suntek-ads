<?php
session_start();
require_once '../db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all products
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Products - Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        header {
            background: #007bff;
            color: white;
            text-align: center;
            padding: 15px;
        }
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            border-bottom: 1px solid #ddd;
            text-align: center;
            padding: 10px;
        }
        th {
            background: #007bff;
            color: white;
        }
        img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
        a.button {
            background: #007bff;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            margin: 0 3px;
        }
        a.button:hover {
            background: #0056b3;
        }
        .no-products {
            text-align: center;
            font-size: 18px;
            margin-top: 40px;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <h1>All Products</h1>
    </header>

    <?php if (count($products) > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price (₦)</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['id']) ?></td>
            <td><img src="../images/<?= htmlspecialchars($product['image']) ?>" alt=""></td>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td><?= number_format($product['price'], 2) ?></td>
            <td>
                <a href="edit_product.php?id=<?= $product['id'] ?>" class="button">Edit</a>
                <a href="delete_product.php?id=<?= $product['id'] ?>" class="button" style="background:red;">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p class="no-products">No products found. <a href="add_product.php">Add one now</a>.</p>
    <?php endif; ?>
</body>
</html>