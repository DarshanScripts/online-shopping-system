# 🛒 Online Shopping System

## Overview

The **Online Shopping System** is a web-based e-commerce platform developed using PHP and MySQL. It enables customers to browse products, add them to a shopping cart, and place orders. The system includes an **admin panel** for managing products, customers, and orders, as well as customer authentication, AJAX-based interactions, and secure form validations.

## ⭐ Features

### User Features
- **User Authentication** – Customers can register, log in, and log out securely.
- **Product Browsing** – Customers can view available products with descriptions and prices.
- **Shopping Cart** – Items can be added, removed, and updated in the cart dynamically.
- **Checkout Process** – Customers can place orders with order summaries and confirmation.
- **Profile Management** – Customers can update their personal details and view past orders.

### Admin Features
- **Admin Dashboard** – Overview of orders, sales, and user activities.
- **Product Management** – Add, edit, delete, and manage product listings.
- **Order Management** – View and process customer orders.
- **Customer Management** – View registered customers and their order history.

### Technical Features
- **CRUD Operations** – Fully functional Create, Read, Update, and Delete operations.
- **AJAX Integration** – Enhances UI interactions without page reloads.
- **Secure Login System** – Uses password hashing and session management.
- **Form Validations** – Ensures correct and complete data input.

---

## 📥 Installation Guide

### Step 1: Clone the Repository
Download the project from GitHub:
```sh
git clone https://github.com/DarshanScripts/online-shopping-system.git
```

### Step 2: Set Up the Database
1. Open **phpMyAdmin** (or any MySQL database manager).
2. Create a new database (e.g., `OnlineShopping`).
3. Copy the provided SQL file, paste it into the SQL panel & run it successfully.
4. Open `DBConnection.php` and update the database credentials.

### Step 3: Configure the Server
1. Move the project folder to `htdocs` (for XAMPP) or `www` (for WAMP/LAMP).
2. Start **Apache** and **MySQL** services using XAMPP/WAMP/LAMP.
3. Open a browser and go to:
   ```sh
   http://localhost/online-shopping-system/
   ```

---

## 📂 Project Structure

```
online-shopping-system/
│── Index.php                # Homepage
│── Login.php                # User Login
│── Logout.php               # Logout Functionality
│── Registration.php         # User Registration
│── DBConnection.php         # Database Configuration
│── TableStructure.sql       # SQL Database Dump
│
├── Admin/
│   ├── AdminReg.php         # Admin Registration
│   ├── AdminLogin.php       # Admin Login
│   ├── AdminLogout.php      # Admin Logout
│   ├── Dashboard.php        # Admin Dashboard
│   ├── InsertShoe.php       # Add New Shoes
│   ├── EditShoe.php         # Edit Existing Shoes
│   ├── FetchCustomer.php    # View & Process Customer Details
│
├── Customer/
│   ├── Homepage.php         # Customer Dashboard
│   ├── CustReg.php          # Customer Registration
│   ├── CustLogin.php        # Customer Login
│   ├── CustLogout.php       # Customer Logout
│   ├── Purchase.php         # Buy Shoes
│   ├── FetchShoes.php       # View & Process Shoes Details
│   ├── UpdateProfile.php    # Profile Management
│   ├── UpdateProSaved.php   # Saves Profile Changes
```

---

## 💻 Technologies Used
- **PHP** – Handles backend logic and interactions.
- **MySQL** – Stores product, customer, and order data.
- **AJAX** – Enables real-time interactions.
- **HTML, CSS, JavaScript** – Creates a dynamic frontend.
- **Bootstrap** – Enhances UI design.

---

## 👨‍💻 Author
Developed by **Darshan Shah**. Connect with me:

- **LinkedIn**: [Darshan Shah](https://www.linkedin.com/in/darshan-shah-tech/)
- **Facebook**: [DarshanScripts](https://www.facebook.com/DarshanScripts)
- **GitHub**: [DarshanScripts](https://github.com/DarshanScripts)
- **Quora**: [Darshan Shah](https://www.quora.com/profile/Darshan-Shah-1056)
- **Medium**: [DarshanScripts](https://medium.com/@DarshanScripts)
- **Fiverr**: [DarshanScripts](https://www.fiverr.com/darshanscripts)

