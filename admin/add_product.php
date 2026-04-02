?php
session_start();
require_once '../db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image is valid
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($imageFileType, $allowed)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Insert product into database
            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $description, $price, $image]);
            $message = "✅ Product added successfully!";
        } else {
            $message = "❌ Error uploading image!";
        }
    } else {
        $message = "❌ Invalid image format! (Use JPG, PNG, or GIF)";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product - Admin Panel</title>
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
            text-decoration: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add New Product</h1>
    </header>

    <form method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" required>

        <label>Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <label>Price (₦):</label>
        <input type="number" name="price" step="0.01" required>

        <label>Product Image:</label>
        <input type="file" name="image" accept="image/*" required>

        <input type="submit" value="Add Product">
        <a href="dashboard.php">← Back to Dashboard</a>
    </form>

    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
</body>
</html>