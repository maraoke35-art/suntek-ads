php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Suntek Store</title>
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
            padding: 15px;
            text-align: center;
        }
        nav {
            background: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 30px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 300px;
            margin: 10px;
            display: inline-block;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, Admin</h1>
    </header>
    <nav>
        <a href="add_product.php">Add Product</a>
        <a href="view_products.php">View Products</a>
        <a href="logout.php">Logout</a>
    </nav>
    <main>
        <h2>Dashboard Overview</h2>
        <div class="card">
            <h3>Manage Products</h3>
            <p>Add, edit, or delete products from the Suntek Store database.</p>
        </div>
        <div class="card">
            <h3>View Orders (coming soon)</h3>
            <p>See all customer orders and track transactions.</p>
        </div>
    </main>
</body>
</html>