<?php
session_start();
include 'database.php';

if (isset($_POST['add_to_cart'])) {
    $item = [
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'],
        'quantity' => $_POST['quantity'] ?? 1
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $exists = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $item['id']) {
            $cartItem['quantity'] += $item['quantity'];
            $exists = true;
            break;
        }
    }

    if (!$exists) {
        $_SESSION['cart'][] = $item;
    }

    $_SESSION['flash'] = "✅ Item added to cart!";
}

// Fetch product
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM productdetails WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product selected.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="pro.css"> 
    <link rel="stylesheet" href="sidebar.css"> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                        <li><a href="index.php#about">About</a></li>
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
                        <li><a href="review.html">Review</a></li>
                    </ul>
                </div>

                <div class="search">
                    <input class="srch" type="search" placeholder="Type to search">
                    <button class="search-btn">Search</button>
                </div>

                <div class="header-icon">
                    <a href="login.php"><i class='bx bxs-user'></i></a>

                    <button type="button" class="heart-btn" onclick="likeProduct(
    <?php echo $product['id']; ?>,
    '<?php echo htmlspecialchars($product['name']); ?>',
    '<?php echo htmlspecialchars($product['image']); ?>'
)">
    <i class='bx bxs-heart heart-icon'></i>
</button> 

                    <a href="cart.php"><i class='bx bxs-cart'></i>
                     
                        <?php
                        if (isset($_SESSION['cart'])) {
                        echo "<span style='color: red; font-weight: bold;'>(".count($_SESSION['cart']).")</span>";
                        }
                        ?>
                    </a>
                    
                </div>
            </div>

            <?php if (isset($_SESSION['flash'])): ?>
        <p style="background:#d4edda; color:#155724; padding:10px; text-align:center; font-weight:bold; border-radius:5px;">
        <?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?>
        </p>
         <?php endif; ?>
        </div>








































































    <section class="main-wrap">
        <div class="product">
            <div class="image-gallery">
                <img src="images/<?php echo htmlspecialchars($product['image']); ?>" id="productImg" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="controls">
                    <span class="btn active"></span>
                    <span class="btn"></span>
                    <span class="btn"></span>
                </div>
            </div>

            <div class="product-details">
                <div class="details">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <div class="product-rating">★ ★ ★ ★ ★</div>
                    <h3>R<?php echo number_format($product['price'], 2); ?></h3>
                    <?php if (!empty($product['description'])): ?>
                        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                    <?php endif; ?>

                    <label class="quantity-label">Quantity:</label>
                    <div class="quantity-container">
                        <button class="quantity-btn minus">−</button>
                        <input type="text" class="quantity-input" value="1" readonly>
                        <button class="quantity-btn plus">+</button>
                    </div>

                    <form method="post" action="" class="sub-btn">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                        <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                        <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
                        <input type="hidden" name="quantity" id="formQuantity" value="1">
                        <button type="submit" name="add_to_cart" class="submit">Add to cart</button>
                        <button type="button" onclick="toggleSidebar()" class="heart-btn">
                            <i class='bx bxs-heart heart-icon'></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <h3>Liked Items</h3>
            <span class="close-btn" onclick="toggleSidebar()">×</span>
        </div>
        <div class="liked-items-container" id="likedItemsContainer">
            <!-- Liked items go here -->
        </div>
    </div>

    <footer class="my-footer mt-5 py-5">
        <div class="footer-main-content">
            <div class="footer-column footer-about">

                <div class="logo-text-container mb-3">
                    <img src="images/logo.png" alt="logo" class="footer-logo mb-2">
                    <h5 class="footer-title">Taraji Furnitures</h5>
                </div>

            <p>Where fashion, comfort, and style meet furniture.</p>
            <p>Our pieces are crafted to transform your space into a reflection of elegance and warmth.</p>
    
            </div>

            <div class="footer-column footer-links">
                <h6>QUICK LINKS</h6>
                <ul>
                    <li><a href="table.php">Tables & Chairs</a></li>
                    <li><a href="tvstand.php">TV Stands</a></li>
                    <li><a href="chouces.php">Couches</a></li>
                    <li><a href="livingroom.php">Living Room</a></li>
                    <li><a href="bed.php">Bedroom</a></li>
                <li><a href="outdoor.php">Outdoor/Patio</a></li>
                </ul>
            
            
             </div>

                <div class="footer-column footer-contact">
                <h5>Contact Us</h5>
                <div><br> 
                <div>
                <h6>PHONE</h6>
                <p>(012) 456 -7890</p>
                </div>

                <div>
                <h6>EMAIL</h6>
                <p>TarajiFurniture@gmail.com</p>
                    </div>
                 </div>

        
                </div>

                <div class="footer-bottom">
                <img src="images/BL1.jpeg" alt="logo" class="">
                </div><br>

                <div class="footer">
                <p>Taraji Furnitures &copy; 2025. All rights reserved.</p> 
            </div> 
        </footer>  

   <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <h3>Liked Items</h3>
            <span class="close-btn" onclick="toggleSidebar()">×</span>
        </div>
        <div class="liked-items-container" id="likedItemsContainer">
            <!-- Liked items go here -->
        </div>
    </div>

    <footer class="my-footer mt-5 py-5">
    </footer> 
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector(".like-toggle");
    const plusBtn = document.querySelector(".plus");
    const minusBtn = document.querySelector(".minus");
    const quantityInput = document.querySelector(".quantity-input");
    const formQuantity = document.getElementById("formQuantity");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function (e) {
            e.preventDefault();
            toggleSidebar();
        });
    }

    if (plusBtn) {
        plusBtn.addEventListener("click", () => {
            let val = parseInt(quantityInput.value);
            quantityInput.value = val + 1;
            formQuantity.value = val + 1;
        });
    }

    if (minusBtn) {
        minusBtn.addEventListener("click", () => {
            let val = parseInt(quantityInput.value);
            if (val > 1) {
                quantityInput.value = val - 1;
                formQuantity.value = val - 1;
            }
        });
    }
});

function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("open");
}
</script>


<script>
function likeProduct(id, name, image) {
    const likedItems = JSON.parse(localStorage.getItem("likedItems")) || [];

    // Check if already liked
    if (!likedItems.find(item => item.id === id)) {
        likedItems.push({ id, name, image });
        localStorage.setItem("likedItems", JSON.stringify(likedItems));
        alert(`${name} added to liked items ❤️`);
        renderLikedItems(); // refresh sidebar
    } else {
        alert(`${name} is already in liked items.`);
    }

    toggleSidebar(); // open the sidebar
}

function renderLikedItems() {
    const likedItems = JSON.parse(localStorage.getItem("likedItems")) || [];
    const container = document.getElementById("likedItemsContainer");
    container.innerHTML = ""; // Clear previous

    if (likedItems.length === 0) {
        container.innerHTML = "<p style='padding: 1rem;'>No liked items yet.</p>";
        return;
    }

    likedItems.forEach(item => {
        const div = document.createElement("div");
        div.classList.add("liked-item");
        div.innerHTML = `
            <img src="images/${item.image}" alt="${item.name}" style="width: 60px; height: auto;">
            <p>${item.name}</p>
        `;
        container.appendChild(div);
    });
}

// Render on page load
document.addEventListener("DOMContentLoaded", renderLikedItems);
</script>

</body>
</html>
