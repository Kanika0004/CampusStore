<?php
session_start();

include "backend/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html?redirect=checkout");
    exit();
}

$user_id = $_SESSION['user_id'];

$address_sql = "SELECT * FROM addresses WHERE user_id = '$user_id' ORDER BY id DESC";
$addresses = $conn->query($address_sql);

$sql = "SELECT products.name, products.price, cart.quantity
        FROM cart
        JOIN products
        ON cart.product_id = products.id
        WHERE cart.user_id = '$user_id'";

$result = $conn->query($sql);

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
        <style>
    /* 👇 ADD BELOW YOUR EXISTING CSS */

    .top-header-wrap {
      max-width: 1240px;
      margin: 18px auto 10px;
      padding: 0 18px;
    }

    .top-header {
      background: #ffffff;
      border: 1px solid #e9eef5;
      border-radius: 22px;
      padding: 14px 18px;
      box-shadow: 0 10px 26px rgba(15, 23, 42, 0.06);
    }

    .brand-logo {
      font-size: 2rem;
      font-weight: 800;
      letter-spacing: -0.04em;
      color: #1769ff;
      text-decoration: none;
    }

    .search-shell {
      background: #f8fafc;
      border: 1px solid #dbe3ee;
      border-radius: 18px;
      padding: 5px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .search-shell #searchInput {
      border: none !important;
      box-shadow: none !important;
      background: transparent;
      padding: 0.8rem 1rem;
      border-radius: 14px;
    }

    .search-shell #searchInput:focus {
      outline: none;
    }

    .search-shell .btn {
      border-radius: 14px;
      font-weight: 600;
      padding: 0.75rem 1.15rem;
    }

    .header-actions {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
    }

    .icon-pill {
      width: 44px;
      height: 44px;
      border-radius: 14px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: #fff;
      border: 1px solid #dbe3ee;
      box-shadow: 0 6px 18px rgba(15, 23, 42, 0.05);
      transition: transform 0.18s ease, box-shadow 0.18s ease;
      text-decoration: none;
    }

    .icon-pill:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
    }
    .modern-input {
  border-radius: 14px;
  padding: 0.75rem 1rem;
  border: 1px solid #dbe3ee;
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
}

.modern-input:focus {
  border-color: #1769ff;
  box-shadow: 0 0 0 2px rgba(23, 105, 255, 0.1);
}
h3, h4, h5 {
  font-weight: 700;
}

.card {
  transition: 0.2s;
}

.card:hover {
  transform: translateY(-2px);
}
</style>
    <title>Checkout</title>
    <meta charset="UTF-8">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    />

    <style>
        .header-actions {
            min-width: 260px;
        }

        @media (max-width: 768px) {
            .header-actions {
                margin-top: 12px;
                width: 100%;
                justify-content: flex-end;
                flex-wrap: wrap;
                gap: 8px !important;
            }

            header {
                gap: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="top-header-wrap">
  <header class="top-header">
    <div class="row align-items-center gx-4 gy-3">
      
      <div class="col-lg-3 col-md-4 col-12">
        <a href="index.html" class="brand-logo">CampusStore</a>
      </div>

      <div class="col-lg-6 col-md-5 col-12 position-relative search-column">
        <form id="searchForm" autocomplete="off" class="search-shell">
          <input type="search" id="searchInput" class="form-control"
            placeholder="Search for books, gadgets, stationery..." />
          <button class="btn btn-primary" type="submit">Search</button>
        </form>
      </div>

      <div class="col-lg-3 col-md-3 col-12">
        <div class="header-actions">

          <a href="login.html" id="loginBtn"
            class="btn btn-outline-primary btn-sm px-3">Login</a>

          <a href="signup.html" id="signupBtn"
            class="btn btn-primary btn-sm px-3 text-nowrap">Sign Up</a>

          <div id="userMenuWrap" class="dropdown" style="display: none;">
            <button
              class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center"
              type="button"
              data-bs-toggle="dropdown"
              style="width: 42px; height: 42px;">
              <i class="bi bi-person-fill"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <span class="dropdown-item-text fw-semibold"
                  id="userWelcome"></span>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="order_history.php">
                  <i class="bi bi-box me-2"></i>My Orders
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="wishlist.html">
                  <i class="bi bi-heart me-2"></i>Wishlist
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="backend/logout.php">
                  <i class="bi bi-box-arrow-right me-2"></i>Logout
                </a>
              </li>
            </ul>
          </div>

          <a href="wishlist.html"
            class="icon-pill text-danger position-relative">
            <i class="bi bi-heart"></i>
          </a>

          <a href="checkout.php"
            class="icon-pill text-primary position-relative">
            <i class="bi bi-cart"></i>
            <span id="cartCount"
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              0
            </span>
          </a>

        </div>
      </div>

    </div>
  </header>
</div>
    </div>

    <div class="container mt-4">
  <div class="p-4 rounded-4 bg-white shadow-sm border">
        <div class="row">

            <div class="col-md-7">
                <h3>Billing Address</h3>

                <form action="backend/place_order.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <input id="first_name" class="form-control modern-input mb-3" name="first_name" placeholder="First Name" required>
                        </div>

                        <div class="col-md-6">
                            <input id="last_name" class="form-control modern-input mb-3" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>

                    <input id="email" type="email" class="form-control modern-input mb-3" name="email" placeholder="Email" required>
                    <input id="address" class="form-control modern-input mb-3" name="address" placeholder="Address" required>
                    <input id="landmark" class="form-control modern-input mb-3" name="landmark" placeholder="Landmark">

                    <div class="row">
                        <div class="col-md-4">
                            <input id="country" class="form-control modern-input mb-3" name="country" placeholder="Country" required>
                        </div>

                        <div class="col-md-4">
                            <input id="state" class="form-control modern-input mb-3" name="state" placeholder="State" required>
                        </div>

                        <div class="col-md-4">
                            <input id="zip" class="form-control modern-input mb-3" name="zip" placeholder="ZIP" required>
                        </div>
                    </div>

                    <h4 class="mt-4">Saved Addresses</h4>

                    <div class="row">
                        <?php if ($addresses && $addresses->num_rows > 0) { ?>
                            <?php while ($addr = $addresses->fetch_assoc()) { ?>
                                <div class="col-md-6 modern-input mb-3">
                                    <div class="card p-3 rounded-4 border-0 shadow-sm h-100">
                                        <strong><?php echo htmlspecialchars($addr['first_name'] . " " . $addr['last_name']); ?></strong>

                                        <p class="mb-1"><?php echo htmlspecialchars($addr['address']); ?></p>

                                        <?php if (!empty($addr['landmark'])) { ?>
                                            <p class="mb-1"><?php echo htmlspecialchars($addr['landmark']); ?></p>
                                        <?php } ?>

                                        <p class="mb-2">
                                            <?php echo htmlspecialchars($addr['state']); ?>,
                                            <?php echo htmlspecialchars($addr['country']); ?> -
                                            <?php echo htmlspecialchars($addr['zip']); ?>
                                        </p>

                                        <button
                                            type="button"
                                            class="btn btn-outline-primary btn-sm useAddress"
                                            data-first="<?php echo htmlspecialchars($addr['first_name']); ?>"
                                            data-last="<?php echo htmlspecialchars($addr['last_name']); ?>"
                                            data-email="<?php echo htmlspecialchars($addr['email']); ?>"
                                            data-address="<?php echo htmlspecialchars($addr['address']); ?>"
                                            data-landmark="<?php echo htmlspecialchars($addr['landmark']); ?>"
                                            data-country="<?php echo htmlspecialchars($addr['country']); ?>"
                                            data-state="<?php echo htmlspecialchars($addr['state']); ?>"
                                            data-zip="<?php echo htmlspecialchars($addr['zip']); ?>"
                                        >
                                            Use this address
                                        </button>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="col-12">
                                <p class="text-muted">No saved addresses yet. Your first placed order will save one here.</p>
                            </div>
                        <?php } ?>
                    </div>

                    <h5 class="mt-4">Payment</h5>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" value="Credit Card" required>
                        <label class="form-check-label">Credit Card</label>
                    </div>
                    <div id="cardDetails" class="mt-3 paymentBox" style="display:none;">
                        <input class="form-control mb-2" placeholder="Card Number">
                        <input class="form-control mb-2" placeholder="Expiry Date">
                        <input class="form-control mb-2" placeholder="CVV">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" value="Debit Card">
                        <label class="form-check-label">Debit Card</label>
                    </div>
                    <div id="debitDetails" class="mt-3 paymentBox" style="display:none;">
                        <input class="form-control mb-2" placeholder="Debit Card Number">
                        <input class="form-control mb-2" placeholder="Expiry Date">
                        <input class="form-control mb-2" placeholder="CVV">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" value="UPI">
                        <label class="form-check-label">UPI</label>
                    </div>
                    <div id="upiDetails" class="mt-3 paymentBox" style="display:none;">
                        <input class="form-control mb-2" placeholder="Enter UPI ID">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" value="COD">
                        <label class="form-check-label">Cash on Delivery</label>
                    </div>
                    <div id="codDetails" class="mt-3 paymentBox" style="display:none;">
                        <p class="text-success">Pay when the order arrives.</p>
                    </div>

                    <button class="btn btn-primary mt-4 w-100 rounded-4 py-2 fw-semibold">
                        Continue to Checkout
                    </button>
                </form>
            </div>

            <div class="col-md-5">
                <div class="d-flex justify-content-end modern-input mb-3">
                    <a href="index.html" class="btn btn-outline-secondary">
                        ← Back to Dashboard
                    </a>
                </div>

                <div class="card p-4 rounded-4 border-0 shadow-sm">
                    <h5>Your Cart</h5>

                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $itemTotal = $row['price'] * $row['quantity'];
                            $total += $itemTotal;

                                        echo "
                <div class='d-flex justify-content-between align-items-center mb-2'>
                    
                    <div>
                        <strong>" . htmlspecialchars($row['name']) . "</strong>
                    </div>

                    <div class='d-flex align-items-center gap-2'>

                        <button class='btn btn-sm btn-outline-secondary minus'
                            data-name='" . htmlspecialchars($row['name']) . "'>-</button>

                        <span>" . (int)$row['quantity'] . "</span>

                    <button class='btn btn-sm btn-outline-secondary plus'
                        data-name='" . htmlspecialchars($row['name']) . "'>+</button>

                    <button class='btn btn-sm btn-outline-danger remove'
                        data-name='" . htmlspecialchars($row['name']) . "'>x</button>

                </div>

                <div>
                    ₹" . $itemTotal . "
                </div>

            </div>
            ";
                        }
                    } else {
                        echo "<p class='text-muted'>Your cart is empty.</p>";
                    }
                    ?>

                    <hr>
                    <h4>Total : ₹<?php echo $total; ?></h4>
                </div>
            </div>

        </div>
    </div>
    </div>

    <script>
    document.querySelectorAll(".useAddress").forEach(btn => {
        btn.addEventListener("click", function () {
            document.getElementById("first_name").value = this.dataset.first || "";
            document.getElementById("last_name").value = this.dataset.last || "";
            document.getElementById("email").value = this.dataset.email || "";
            document.getElementById("address").value = this.dataset.address || "";
            document.getElementById("landmark").value = this.dataset.landmark || "";
            document.getElementById("country").value = this.dataset.country || "";
            document.getElementById("state").value = this.dataset.state || "";
            document.getElementById("zip").value = this.dataset.zip || "";

            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    });
    </script>

    <script>
    const payments = document.querySelectorAll('input[name="payment"]');

    payments.forEach(payment => {
        payment.addEventListener("change", function () {
            document.querySelectorAll(".paymentBox").forEach(box => {
                box.style.display = "none";
            });

            if (this.value === "Credit Card") {
                document.getElementById("cardDetails").style.display = "block";
            }

            if (this.value === "Debit Card") {
                document.getElementById("debitDetails").style.display = "block";
            }

            if (this.value === "UPI") {
                document.getElementById("upiDetails").style.display = "block";
            }

            if (this.value === "COD") {
                document.getElementById("codDetails").style.display = "block";
            }
        });
    });
    </script>

    <script src="js/cart.js"></script>
    <script src="js/navbar.js"></script>

    <script>
    fetch("backend/get_cart.php")
        .then(res => res.json())
        .then(data => {
            let count = 0;
            data.forEach(item => {
                count += parseInt(item.quantity) || 0;
            });
            document.getElementById("cartCount").innerText = count;
        });
    </script>

    <script>
    fetch("backend/get_user.php")
        .then(res => res.json())
        .then(data => {
            if (data.logged_in) {
                document.getElementById("loginBtn").style.display = "none";
                document.getElementById("signupBtn").style.display = "none";
                document.getElementById("userMenuWrap").style.display = "block";

                let name = data.name.split(" ")[0];
                document.getElementById("userWelcome").innerText = "Hi, " + name;
            }
        });
    </script>
    <script>
document.querySelectorAll(".plus").forEach(btn => {
    btn.onclick = function () {
        let name = this.dataset.name;

        fetch("backend/update_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                name: name,
                action: "increase"
            })
        }).then(() => location.reload());
    };
});

document.querySelectorAll(".minus").forEach(btn => {
    btn.onclick = function () {
        let name = this.dataset.name;

        fetch("backend/update_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                name: name,
                action: "decrease"
            })
        }).then(() => location.reload());
    };
});

document.querySelectorAll(".remove").forEach(btn => {
    btn.onclick = function () {
        let name = this.dataset.name;

        fetch("backend/update_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                name: name,
                action: "remove"
            })
        }).then(() => location.reload());
    };
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>