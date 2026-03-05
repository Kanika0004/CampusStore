# CampusStore

CampusStore is a **campus-focused e-commerce web application** where students can browse products, add items to cart, save addresses, place orders, and view their order history.

The project demonstrates a **complete e-commerce workflow** using PHP, MySQL, JavaScript, and Bootstrap.

---

# Features

- User Login and Signup
- Dynamic Navbar based on login state
- Add to Cart functionality
- Checkout page with billing address form
- Saved address management
- Payment method selection
- Order placement system
- Order success confirmation
- Order history page
- Session-based authentication

---

# Tech Stack

### Frontend
- HTML
- Bootstrap 5
- JavaScript (Fetch API)

### Backend
- PHP

### Database
- MySQL

---

# Project Structure

```
CampusStore
│
├── backend
│   ├── db.php
│   ├── add_to_cart.php
│   ├── place_order.php
│   ├── save_address.php
│   ├── get_cart.php
│   ├── get_user.php
│   └── logout.php
│
├── js
│   └── cart.js
│
├── public
│   └── product images
│
├── index.html
├── checkout.php
├── order_history.php
├── order_success.php
├── login.html
├── signup.html
│
├── database.sql
└── README.md
```

---

# Database Setup

1. Open **phpMyAdmin**

2. Create a database named:

```
campusstore
```

3. Import the file:

```
database.sql
```

This will automatically create the required tables:

- users
- products
- cart
- addresses
- orders

---

# Running the Project

1. Clone the repository

```
git clone https://github.com/YOUR_USERNAME/CampusStore.git
```

2. Move the project to your server folder

Example (XAMPP):

```
xampp/htdocs/CampusStore
```

3. Start **Apache** and **MySQL**

4. Import `database.sql` into phpMyAdmin

5. Open the project in browser

```
http://localhost/CampusStore
```

---

# User Flow

```
Login
   ↓
Browse Products
   ↓
Add to Cart
   ↓
Checkout Page
   ↓
Select / Save Address
   ↓
Choose Payment Method
   ↓
Place Order
   ↓
Order Stored in Database
   ↓
View Order History
```
