<?php
session_start();
include 'database.php'; 

$loginError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Check password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: index.php"); 
            exit();
        } else {
            $loginError = "Invalid password.";
        }
    } else {
        $loginError = "No account found with that email.";
    }
}
?>



<?php
$successMsg = '';
if (isset($_GET['success']) && $_GET['success'] == '1') {
    $successMsg = "✅ Account created successfully! Please log in.";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <title>login form </title>
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
                                    <li><a href="#about">About</a></li>
                                    <li><a href="signup.php">Register</a></li> 
                                    <li><a href="#">Contact</a></li>    
                                  </ul>
                             </div>
                               <!--The Search-bar Button-->
                               <div class="search">
                                 <input class="srch" type="search" placeholder="Type to search">
                                 <button class="search-btn">Search</button>
                             </div>
                      </div>  
                </div>
         </div>

          <div Class="content">
            <h1>Welcome Back!</h1><br>
            <h2>Let's Furnish Your <br>Space With <br> Style & Comfort.</h2>
          </div>
     </div>


        <div class="form active">
          <h2>Login Here</h2>

            <?php if (!empty($loginError)): ?>
              <p style="color: red; font-weight: bold;"><?php echo $loginError; ?></p>
            <?php endif; ?>
          <form method="POST" action="login.php">

            <div class="input-box"> 
              <input type="email" name="email" placeholder="Enter Email Here" required>
              <i class='bx  bxs-envelope bx-rotate-90 bx-flip-horizontal'  style='color:#5d5d59'></i>
            </div><br>

              <div class="input-box">
                <input type="password" name="password" placeholder="Enter Password Here" required>
                <i  class='bx bxs-low-vision visibility-toggle' style='color:#5d5d59'></i> <br><br>
              </div> 
                 
                <div class="forgot-link">
                  <a href="forgotPassword.php">Forgot Password?</a>
               </div>

                <div style="display: flex; gap: 10px; align-items: center;">
                  <button type="submit" class="btn">Login</button>
                  <a href="admin2.html" class="btn" style="text-decoration: none; padding: 10px 20px;">Admin</a>
              </div>
              <br><br>


                <div class="Register link">
                  <P>Don't have an account? <a href="<?php echo 'signup.php'; ?>">Register Here</a></P>
      </div>
              </form>
   <script src="main.js"></script>
    </div>
  </body>
</html>