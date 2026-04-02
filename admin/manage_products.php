<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

include '../db_connect.php';

// ADD PRODUCT
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    // Handle image upload
    $image = $_FILES['image']['name'];
    $target = "../uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $image]);
    $message = "Product added successfully!";
}

// DELETE PRODUCT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: manage_products.php");
    exit();
}

// FETCH PRODUCTS
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products - Suntek Admin</title>
    <style>
        body { font-family: Arial; background: #f8f9fa; margin: 0; }
        header { background: #007bff; color: white; padding: 15px; text-align: center; }
        main { padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #007bff; color: white; }
        img { width: 80px; height: 80px; object-fit: cover; }
        form { background: white; padding: 20px; margin-bottom: 20px; border-radius: 10px; }
        input, textarea { width: 100%; padding: 8px; margin: 5px 0; }
        input[type=submit] { background: #28a745; color: white; border: none; cursor: pointer; padding: 10px; }
        input[type=submit]:hover { background: #218838; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <header>
        <h2>Manage Products</h2>
    </header>

    <main>
        <h3>Add New Product</h3>
        <form method="POST" enctype="multipart/form-data">
            <label>Product Name:</label>
            <input type="text" name="name" required>
            <label>Description:</label>
            <textarea name="description" required></textarea>
            <label>Price:</label>
            <input type="number" name="price" step="0.01" required>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" required>
            <input type="submit" name="add_product" value="Add Product">
        </form>

        <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

        <h3>Existing Products</h3>
        <table>
            <tr>
                <th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Image</th><th>Actions</th>
            </tr>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id']; ?></td>
                <td><?= htmlspecialchars($product['name']); ?></td>
                <td><?= htmlspecialchars($product['description']); ?></td>
                <td>$<?= number_format($product['price'], 2); ?></td>
                <td><img src="../uploads/<?= $product['image']; ?>" alt=""></td>
                <td>
                    <a href="edit_product.php?id=<?= $product['id']; ?>">Edit</a> |
                    <a href="?delete=<?= $product['id']; ?>" onclick="return confirm('Delete this product?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>