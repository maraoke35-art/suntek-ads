<?php
session_start();
require_once '../db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Get product ID
if (!isset($_GET['id'])) {
    die("Product ID is missing!");
}

$id = intval($_GET['id']);
$message = "";

// Fetch product details
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    die("Product not found!");
}

// Handle update submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $image = $product['image']; // Keep old image by default

    // Check if a new image was uploaded
    if (!empty($_FILES['image']['name'])) {
        $new_image = $_FILES['image']['name'];
        $target_dir = "../images/";
        $target_file = $target_dir . basename($new_image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowed)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Delete old image file
                if (file_exists("../images/" . $product['image'])) {
                    unlink("../images/" . $product['image']);
                }
                $image = $new_image;
            } else {
                $message = "❌ Error uploading new image!";
            }
        } else {
            $message = "❌ Invalid image format! (Use JPG, PNG, or GIF)";
        }
    }

    // Update product in database
    $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $image, $id]);
    $message = "✅ Product updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - Suntek Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            margin: 0;
        }
        header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
        }
        form {
            background: white;
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        img {
            width: 100px;
            display: block;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        input[type=submit] {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background: #0056b3;
        }
        .message {
            text-align: center;
            font-weight: bold;
            color: green;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Product</h1>
    </header>

    <form method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

        <label>Description:</label>
        <textarea name="description" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>

        <label>Price (₦):</label>
        <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required>

        <label>Current Image:</label>
        <img src="../images/<?= htmlspecialchars($product['image']) ?>" alt="Product Image">

        <label>Upload New Image (optional):</label>
        <input type="file" name="image" accept="image/*">

        <input type="submit" value="Update Product">
        <a href="view_products.php">← Back to Product List</a>
    </form>

    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
</body>
</html>