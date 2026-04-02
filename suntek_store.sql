-- Suntek Store SQL (Bootstrap Admin Panel)
CREATE DATABASE IF NOT EXISTS suntek_store;
USE suntek_store;
CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  category VARCHAR(100),
  description TEXT,
  price DECIMAL(10,2) NOT NULL,
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  total_amount DECIMAL(10,2) NOT NULL,
  shipping_address TEXT,
  payment_method VARCHAR(50),
  order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  quantity INT NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
) ENGINE=InnoDB;
-- default admin user (username: admin, password: admin123)
INSERT INTO admins (username,password) VALUES ('admin','$2y$10$wH5tqH2Z7nYd1C/6Y8sTPO0G4nYcQnXrIu1v0G6k9QZfVdKf3Yk9K');
-- sample user (password: password123)
INSERT INTO users (name,email,password) VALUES ('Test User','test@example.com','$2y$10$K1QKjT8w8sG6Z7p1gGqT6u0yF3X8e0KjX0O6hZx3bYc1f8pQZp1a');
-- sample products
INSERT INTO products (name,category,description,price,image) VALUES ('Laptop Pro 14','Electronics','14-inch laptop with 8GB RAM and 256GB SSD',899.99,'images/laptop-pro.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Smartphone X','Electronics','6.5-inch display, 128GB storage',499.99,'images/smartphone-x.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Wireless Headphones','Accessories','Noise-cancelling over-ear headphones',149.99,'images/headphones.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('4K Action Camera','Electronics','Rugged action camera with 4K recording',199.99,'images/camera-4k.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Smart TV 50"','Electronics','50-inch Smart LED TV with HDR',599.99,'images/smarttv-50.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Bluetooth Speaker','Accessories','Portable speaker with deep bass',79.99,'images/speaker.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Smartwatch Gen2','Electronics','Smartwatch with fitness tracking',199.99,'images/smartwatch.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('USB-C Fast Charger','Accessories','Fast 30W USB-C charger',29.99,'images/charger.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Mechanical Keyboard','Accessories','RGB mechanical keyboard',89.99,'images/keyboard.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Blender Pro','Home Appliances','High-speed blender with glass jar',129.99,'images/blender.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Microwave 700W','Home Appliances','700W microwave with grill',159.99,'images/microwave.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Standing Fan','Home Appliances','3-speed standing fan',99.99,'images/fan.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Iron Steam 2000','Home Appliances','Steam iron with non-stick soleplate',49.99,'images/iron.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Washing Machine 7kg','Home Appliances','7kg top-load washing machine',399.99,'images/washing-machine.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('SSD 1TB','Accessories','1TB NVMe SSD',129.99,'images/ssd-1tb.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Noise-Isolating Earbuds','Accessories','In-ear earbuds with mic',59.99,'images/earbuds.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('DSLR Camera 24MP','Electronics','24MP DSLR with kit lens',699.99,'images/dslr-24mp.jpg');
INSERT INTO products (name,category,description,price,image) VALUES ('Portable Projector','Electronics','Compact projector for home cinema',249.99,'images/projector.jpg');