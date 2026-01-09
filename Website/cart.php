<?php
session_start();
include 'database.php';    

// Handle Add to Cart (from other pages)
if (isset($_POST['add_to_cart'])) {
    $item = [
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'],
        'quantity' => 1
    ];

    // If cart doesn't exist, create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if item already in cart
    $exists = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $item['id']) {
            $cartItem['quantity'] += 1;
            $exists = true;
            break;
        }
    }
    if (!$exists) {
        $_SESSION['cart'][] = $item;
    }

    $_SESSION['flash'] = "✅ Item added to cart!";
    header("Location: cart.php");
    exit();
}

// Handle Remove
if (isset($_GET['remove'])) {
    $removeIndex = $_GET['remove'];
    unset($_SESSION['cart'][$removeIndex]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex
    $_SESSION['flash'] = "🗑️ Item removed.";
    header("Location: cart.php");
    exit();
}

// Calculate total
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" href="card.css"> 
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="main">
            <div class="top-navbar">
                <img src="images/logo.png" alt="Taraji Furniture logo" class="logo">
                <div class="navbar">
                    <div class="heading">
                        <h1>Taraji Furnitures</h1>
                    </div>
                                    <div class="menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#home.html#about">About</a></li>
                        <li><a href="products.php">Products</a></li>
                        
                        <li class="dropdown">
                            <a href="#">Shop by Products</a>
                            <div class="dropdown_menu">
                                <ul>
                                    <li><a href="table.php">Tables&Chairs</a></li>
                                    <li><a href="tvStand.php">Tv Stands</a></li>
                                    <li><a href="couches.php">Couches</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#">Shop by room</a>
                            <div class="dropdown_menu">
                                <ul>
                                    <li><a href="livingroom.php">Living Room</a></li>
                                    <li><a href="bed.php">Bedroom</a></li>
                                    <li><a href="outdoor.php">Outdoor/Patio</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="http://127.0.0.1:5500/review.html">Review</a></li>
                    </ul>
                </div>

             

                    <div class="search">
                        <input class="srch" type="search" placeholder="Type to search">
                        <button class="search-btn">Search</button>
                    </div>

                    <div class="header-icon">
                        <a href="login.php"><i class='bx bxs-user'></i></a>

                        <a href="javascript:void(0);" class="like-toggle">
                            <i class='bx bxs-heart'></i>
                        </a>



                        <a href="#"><i class='bx bxs-cart'></i></a> 
                         
                            <?php
                            if (isset($_SESSION['cart'])) {
                            echo "<span style='color: red; font-weight: bold;'>(".count($_SESSION['cart']).")</span>";
                            }
                            ?>
                        </a>
                    </div>
                </div>
                
            </div>

            <?php if (isset($_SESSION['flash'])): ?>
            <p style="background:#d4edda; color:#155724; padding:10px; text-align:center; font-weight:bold; border-radius:5px;">
            <?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?>
            </p>
            <?php endif; ?>


            <div class="cart-heading">
                <h2>Items Added to Your Shopping Cart!</h2>
            </div>
          
           
            <table id="cart">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody id="cart-items">

                    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                    <tr>
                        <td>
                            <img src="images/<?php echo htmlspecialchars($item['image']); ?>" 
                            alt="<?php echo htmlspecialchars($item['name']); ?>" 
                            style="width:80px; height:auto;">
                        </td>
                        
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>R<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>R<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    <td><a href="cart.php?remove=<?php echo $index; ?>" style="color: red;">Remove</a></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr><td colspan="6" style="text-align:center;">Your cart is empty.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <br>
            <p class="total">Total: R<span id="cart-total"><?php echo number_format($total, 2); ?></span></p>
            </p>
                <br>
            <button class="checkout-btn" onclick="window.location.href='checkout.php'">Checkout</button>

            <!-- Link to external JavaScript -->
            <script src="main.js"></script>     




        </div> 
    </body>
</html>