Suntek Store - Professional (Bootstrap Admin Panel)
-----------------------------------------------

What's included:
- Complete PHP + MySQL project ready for localhost (XAMPP/WAMP)
- Bootstrap-styled Admin Panel (admin/ folder) with product management and orders view
- Image upload support (uploads/ folder)
- SQL dump (suntek_store.sql) that creates necessary tables and inserts sample data
- Placeholder product images in /images/

Default credentials:
- Admin: username = admin, password = admin123
- Sample user: email = test@example.com, password = password123

How to install locally (Windows with XAMPP):
1. Install XAMPP from https://www.apachefriends.org/ (if not installed).
2. Extract this project into your web root, e.g. C:\xampp\htdocs\suntek-store-pro
3. Start Apache and MySQL in XAMPP Control Panel.
4. Open phpMyAdmin (http://localhost/phpmyadmin) and import the file 'suntek_store.sql' from the project root.
   - This creates the database and sample data.
5. Make sure folder 'uploads' is writable by the webserver. On Windows it's fine by default.
6. Visit http://localhost/suntek-store-pro/ to view the frontend.
7. Visit http://localhost/suntek-store-pro/admin/admin_login.php to access the admin panel.

Security notes & suggestions:
- The default admin password is provided for demo purposes. Change it after first login.
- For production, use HTTPS and stronger server hardening.
- Consider limiting allowed file types and scanning uploads for malicious content.
- For better file handling, you can store images in cloud storage or serve them via a CDN.

If you want me to:
- Add admin user management (create/remove admins) ✅
- Add order status updates (processing/completed) ✅
- Integrate real payment gateway (Paystack/Stripe) in test mode ✅
reply and I'll implement the next feature.

Enjoy!