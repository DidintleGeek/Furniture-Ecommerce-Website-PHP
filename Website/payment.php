<?php
session_start();

// Default to showing the payment form
$showPaymentForm = true;

// If coming from checkout.php with shipping info
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['step']) && $_POST['step'] === 'shipping') {
    $_SESSION['shipping'] = $_POST;
    // Stay on payment form
}

// If submitting actual card payment
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['step']) && $_POST['step'] === 'payment') {
    $showPaymentForm = false; // Now we show the loader and success
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Payment</title>
    <link rel="stylesheet" href="payment.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">

    <style>
        /* Loader circle */
        .loader {
            margin: 20px auto;
            border: 6px solid #f3f3f3;
            border-top: 6px solid purple;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Success message styling */
        .success-message {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 15px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            border-radius: 6px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="main">
        
        <div class="container">

         <?php if (!$showPaymentForm): ?>
    <!-- Loader and message container -->
    <div id="payment-status">
        <div class="loader"></div>

        <div class="success-message" style="display:none;">
            Payment Successful 🎉 Thank you for your purchase!
            <br><br>
            <a href="index.php" class="shop-more-btn">🛍️ Shop More</a>
        </div>
    </div>

    <style>
        .shop-more-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color:  White;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .shop-more-btn:hover {
            background-color: #c47979;
        }
    </style>

                <script>
                    // After 9 seconds, hide loader and show success message
                    setTimeout(() => {
                        document.querySelector('.loader').style.display = 'none';
                        document.querySelector('.success-message').style.display = 'block';
                    }, 9000);
                </script>

            <?php else: ?>
                <form method="post" action="payment.php">
                    <input type="hidden" name="step" value="payment">
                    <h3 class="title">Payment</h3>
                    
                    <img src="images/card_img.png" alt="" />
                    <br /><br />

                    <div class="inputBox">
                        <span>Name on card :</span>
                        <input type="text" name="cardname" required />
                    </div>

                    <div class="inputBox">
                        <span>Credit card number :</span>
                        <input type="number" name="cardnumber" inputmode="numeric" pattern="\d{16}" maxlength="16" required />
                    </div>  

                    <div class="flex">
                        <div class="inputBox">
                            <span>Exp Date :</span>
                            <input type="text" name="expdate" placeholder="MM/Year" pattern="(0[1-9]|1[0-2])\/[0-9]{4}" required />
                        </div>
                        <div class="inputBox">
                            <span>CVV :</span>
                            <input type="text" name="cvv" placeholder="1234" maxlength="4" pattern="\d{3,4}" required />
                        </div>
                    </div>

                    <input type="submit" value="Process Payment" class="submit-btn" />
                </form>
            <?php endif; ?>

        </div>   
    </div> 
</body>
</html>
