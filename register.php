<?php require 'db_connect.php'; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><title>Register - Suntek Store</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="css/style.css"></head>
<body><nav class="navbar navbar-dark bg-dark"><div class="container"><a class="navbar-brand" href="index.php">Suntek Store</a></div></nav>
<div class="container mt-3"><h2>Create Account</h2><form method="post" action="process_register.php">
<div class="mb-3"><label class="form-label">Name</label><input name="name" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
<button class="btn btn-primary">Register</button></form><p class="mt-2">Already have an account? <a href="login.php">Login</a></p></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script></body></html>