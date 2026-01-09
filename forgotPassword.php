<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css"> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body> 
    <div class="main">
        <div class="top-bar">
            <div class="navbar">
                <div class="icon">
                    <div class="logo">
                        <h1>Taraji Furnitures</h1>
                    </div>
                    <div class="menu">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="signup.php">Register</a></li> 
                            <li><a href="#">Contact</a></li>    
                        </ul>
                    </div>
                </div>              
            </div>
        </div>
    </div>

    <div class="forgotPassword-form">
        <h2>Forgot Password?</h2><br>

        <p>Enter your email address to reset password</p>

        <!-- Start of form -->
        <form method="post" action="resetPassword.php">
            <div class="input-field">
                <input type="email" name="email" placeholder="Enter Email Here" required>
            </div><br>

            <input type="submit" class="btn" value="Send reset link"><br><br>
        </form>
        <!-- End of form -->

        <div class="Register link">
            <p>Don't have an account? <a href="signup.php">Register Here</a></p>
        </div>
    </div>

    <script src="main.js"></script>
</body>
</html>
