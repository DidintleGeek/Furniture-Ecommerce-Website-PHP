<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shipping Details</title>
    <link rel="stylesheet" href="checkout.css"> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <br><br><br><br>
        <form method="post" action="payment.php">
            <h2>Billing Details</h2>
            <br><br>
            <div class="row">
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address1">Address Line 1:</label>
                <input type="text" id="address1" name="address1" required>
            </div>
            <div class="form-group">
                <label for="address2">Address Line 2:</label>
                <input type="text" id="address2" name="address2" required>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="town">Town/City:</label>
                    <input type="text" id="town" name="town" required>
                </div>
                <div class="form-group">
                    <label for="pcode">Postal Code:</label>
                    <input type="text" id="pcode" name="pcode" required>
                </div>
            </div>
            <label for="payment">Payment</label>
            <select id="payment" name="payment">
                <option value="visa">Visa</option>
                <option value="Mastercard">Mastercard</option>
            </select>


            <div>
                <input type="hidden" name="step" value="shipping">
                <input type="submit" value="Proceed to Payment">
            </div>
        </form>
    </div> 
</body>
</html>
