<?php
require_once 'db_connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suntek Store | Online Shopping</title>

    <style>
        /* ===== Global Styles ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
           
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: url('images/store-bg2.jpg') no-repeat center center fixed;
    background-size: cover;
    body {
        }

        /* ===== Header/Navbar ===== */
        header {
            background: linear-gradient(90deg, #007BFF, #00C6FF);
            padding: 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        /* Header Layout */
header {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding: 20px 40px;
  background: transparent;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 10;
}

/* Logo Style */
.logo {
  font-size: 28px;
  font-weight: bold;
  color: #ffcc00;
  text-shadow: 0 0 15px #ffcc00, 0 0 25px #ffaa00;
  animation: fadeBlink 4s ease-in-out infinite;
}

/* Animation for appearing and disappearing */
@keyframes fadeBlink {
  0%, 100% { 
    opacity: 0.4; 
    text-shadow: 0 0 5px #ffcc00; 
  }
  50% { 
    opacity: 1; 
    text-shadow: 0 0 25px #ffaa00, 0 0 50px #ffcc00; 
  }
}
        header h1 {
            font-size: 24px;
            font-weight: 700;
        }
        nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: 500;
        }
        nav a:hover {
            text-decoration: underline;
        }

        /* ===== Hero Section ===== */
        .hero {
            background: url('images/hero-bg.jpg') no-repeat center center/cover;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }
        .hero {
  text-align: center;
  padding: 100px 0;
  background: linear-gradient(to right, #111, #333);
  color: #ffcc00;
  font-size: 36px;
  font-weight: bold;
}
.hero {
  text-align: center;
  padding: 120px 20px;
  color: #ffcc00;
  font-size: 36px;
  font-weight: bold;
  position: relative;
  overflow: hidden;
  min-height: 80vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: rgba(0, 0, 0, 0.6); /* 👈 semi-transparent dark overlay */
  backdrop-filter: blur(4px);      /* 👈 optional soft blur for modern look */
}

.hero h2 {
  text-shadow: 0 0 15px #ffcc00, 0 0 30px #ffaa00;
}
        .hero h2 {
            font-size: 48px;
            background: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 8px;
            .hero {
    text-align: center;
    padding: 100px 0;
}

.hero h2 {
    font-size: 36px;
    color: #ffcc00;
    font-weight: bold;
    text-align: center;
    overflow: hidden;
    white-space: nowrap;
    border-right: 3px solid #ffcc00;
    width: 0;
    display: inline-block;
    animation: typing 3s steps(25, end) forwards, blink 0.7s step-end infinite, float 5s ease-in-out 3s infinite;
}

/* Typing animation */
@keyframes typing {
    from { width: 0; }
    to { width: 320px; } /* Adjust based on text length */
}

/* Blinking cursor animation */
@keyframes fadeBlink {
  0%, 100% {
    opacity: 0.4;
    text-shadow: 0 0 5px #ffcc00;
  }
  50% {
    opacity: 1;
    text-shadow: 0 0 25px #ffaa00, 0 0 50px #ffcc00;
  }
}

/* Floating side-to-side motion */
@keyframes float {
    0% { transform: translateX(0); }
    50% { transform: translateX(15px); }
    100% { transform: translateX(0); }
}
        }

        /* ===== Product Section ===== */
        .products {
            padding: 50px 80px;
        }
        .products h2 {
            text-align: center;
            margin-bottom: 30px;
            color:rgb(245, 247, 250);
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }
        .product {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            padding: 20px;
            transition: transform 0.3s;
        }
        .product:hover {
            transform: translateY(-5px);
        }
        .product img {
            width: 100%;
            height: 200px;
            border-radius: 8px;
            object-fit: cover;
        }
        .product h3 {
            margin: 15px 0 5px;
        }
        .product p {
            color: #555;
        }
        .product button {
            background: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .product button:hover {
            background: #0056b3;
        }

        /* ===== Footer ===== */
        footer {
            background: #343a40;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 50px;
        }
        footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <body>
  <header>
    <h1 class="logo">Suntek Store</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Shop</a>
            <a href="cart.php">Cart</a>
            <?php if (!empty($_SESSION['user_id'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- Hero -->
    <section class="hero">
  <h2 id="suntek-text"></h2>
</section>

    <!-- Product Section -->
    <section class="products">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <div class="product">
                <img src="images/products/laptop.jpg" alt="Laptop">
                <h3>HP Spectre Laptop</h3>
                <p>₦350,000</p>
                <button>Add to Cart</button>
            </div>
            <div class="product">
                <img src="images/products/smartphone-x.jpg" alt="Smartphone">
                <h3>Samsung Galaxy S24</h3>
                <p>₦280,000</p>
                <button>Add to Cart</button>
            </div>
            <div class="product">
                <img src="images/products/headphones.jpg" alt="Headphones">
                <h3>Sony Noise Cancelling Headphones</h3>
                <p>₦85,000</p>
                <button>Add to Cart</button>
            </div>
            <div class="product">
                <img src="images/products/watch.jpg" alt="Smart Watch">
                <h3>Apple Watch Series 9</h3>
                <p>₦220,000</p>
                <button>Add to Cart</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© <?php echo date("Y"); ?> Suntek Store. All rights reserved.</p>
    </footer>
    <script>
  const text = "Shop Smart, Live Better ⭐️";
  const element = document.getElementById("suntek-text");
  let i = 0;

  function typeWriter() {
    if (i < text.length) {
      element.innerHTML += text.charAt(i);
      i++;
      setTimeout(typeWriter, 100); // typing speed
    } else {
      floatText();
    }
  }

  function floatText() {
    element.style.position = "relative";
    let direction = 1;
    setInterval(() => {
      element.style.left = direction * 10 + "px";
      direction *= -1;
    }, 1000);
  }

  // start animation
  typeWriter();
</script>
<script>
  const text = "Shop Smart, Live Better ⭐️";
  const element = document.getElementById("suntek-text");
  let i = 0;

  function typeWriter() {
    if (i < text.length) {
      element.innerHTML += text.charAt(i);
      i++;
      setTimeout(typeWriter, 100);
    } else {
      floatText();
    }
  }

  function floatText() {
    element.style.position = "relative";
    let direction = 1;
    setInterval(() => {
      element.style.left = direction * 10 + "px";
      direction *= -1;
    }, 1000);
  }

  // Start animation when page loads
  window.onload = typeWriter;
</script>

</body>
</html>