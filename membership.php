<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>attireful.</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
        <header>
            <div class="header-left">
                <h1>attireful.</h1>
            </div>
            <div class="header-right">
                <div class="dropdown">
                    <button onclick="toggleDropdown()" class="dropbtn">
                        Membership
                    </button>
                    <div id="membershipDropdown" class="dropdown-content">
                        <a href="signup.html">Sign Up</a>
                        <a href="login.html">Log In</a>
                    </div>
                </div>
                <div id="cartSidebar" class="sidebar">
                    <a
                        href="javascript:void(0)"
                        class="closebtn"
                        onclick="closeCart()"
                        >&times;</a
                    >
                    <div class="cart-content">
                        <h2>Cart</h2>
                        <ul id="cartItems"></ul>
                        <div class="buy-now-wrapper">
                            <button class="buy-now-sidebar" onclick="buyNow()">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>
                <a id="cartButton" onclick="openCart()">Cart</a>
            </div>
        </header>

        <nav class="nav">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="catalog.html">Catalog</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>

        <div class="dashboard">
            <h2>Welcome</h2>
            <div class="user-info">
                <h3>User Information</h3>
                <?php
include("db.php");

            $user_id = 1; 
            $sql = "SELECT email FROM users WHERE id = $user_id"; 
            $result = $conn->query($sql); if ($result->num_rows > 0) { while
                ($row = $result->fetch_assoc()) { echo "
                <p>Email: " . $row["email"] . "</p>
                "; } } else { echo "0 results"; } $conn->close(); ?>
                <p>Password: ***********</p>
                <button>Change Password</button>
            </div>

            <div class="orders">
                <h3>Recent Orders</h3>
                <?php foreach ($paymentIntents->data as $paymentIntent) { ?>
                <div class="order-item">
                    <p>
                        Order ID:
                        <?php echo $paymentIntent->id; ?>
                    </p>
                    <p>
                        Date:
                        <?php echo date("Y-m-d", $paymentIntent->created); ?>
                    </p>
                    <p>
                        Total Amount:
                        <?php echo number_format($paymentIntent->amount / 100,
                        2); ?> USD
                    </p>
                </div>
                <?php } ?>
            </div>

            <div class="preferences">
                <h3>Preferences</h3>
                <div class="preference-item">
                    <p>Marketing Emails: <span id="marketingPref">Yes</span></p>
                    <p>SMS Messages: <span id="smsPref">Yes</span></p>
                </div>
                <button id="editPreferences">Edit Preferences</button>

                <div id="dropdownPreferences" class="hidden">
                    <select id="marketingDropdown">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    <select id="smsDropdown">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    <button id="savePreferences">Save</button>
                </div>
            </div>
        </div>

        <footer>
            <div class="footer-info">
                <h3>attireful</h3>
                <p>123 Address Rd</p>
                <p>Email: contact@attireful.com</p>
                <p>Phone: +1234567890</p>
                <p>&copy; 2023 attireful</p>
            </div>
            <div class="footer-links">
                <div class="connect">
                    <h4>Connect with Us</h4>
                    <div class="social-icons">
                        <a href="#"
                            ><img src="facebook.png" alt="Facebook"
                        /></a>
                        <a href="#"><img src="twitter.png" alt="Twitter" /></a>
                        <a href="#"
                            ><img src="instagram.png" alt="Instagram"
                        /></a>
                    </div>
                </div>
                <div class="policies">
                    <h4>Policies</h4>
                    <div class="policy-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Shipping Policy</a>
                        <a href="#">Return Policy</a>
                    </div>
                </div>
            </div>
        </footer>
        <script>
            document.getElementById("editPreferences").addEventListener("click", function() {
                document.getElementById("dropdownPreferences").classList.toggle("hidden");
            });

            document.getElementById("savePreferences").addEventListener("click", function() {
                var marketingPref = document.getElementById("marketingDropdown").value;
                var smsPref = document.getElementById("smsDropdown").value;

                document.getElementById("marketingPref").textContent = marketingPref.charAt(0).toUpperCase() + marketingPref.slice(1);
                document.getElementById("smsPref").textContent = smsPref.charAt(0).toUpperCase() + smsPref.slice(1);

                document.getElementById("dropdownPreferences").classList.add("hidden");
            });
        </script>
    </body>
</html>
