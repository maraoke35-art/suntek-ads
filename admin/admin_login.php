<?php
session_start();

$error = ''; // initialize error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Only read form data if the form was actually submitted
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Default admin credentials
    $admin_email = "admin@suntek.com";
    $admin_pass = "admin123";

    if ($email === $admin_email && $password === $admin_pass) {
        $_SESSION['admin'] = $email;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Suntek Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #007bff, #00aaff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .login-box h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type=submit] {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type=submit]:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <form method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
</body>
</html>