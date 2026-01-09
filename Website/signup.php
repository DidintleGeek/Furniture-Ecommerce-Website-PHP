
<?php
include 'database.php'; 

$registerMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? '';

    if ($password !== $confirmPassword) {
        $registerMsg = "❌ Passwords do not match.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prevent duplicates
        $checkEmail = "SELECT * FROM users WHERE email = '$email'";
        $checkResult = $conn->query($checkEmail);

        if ($checkResult->num_rows > 0) {
            $registerMsg = "❌ Email already exists.";
        } else {
            $sql = "INSERT INTO users (firstname, lastname, email, password, role)
                    VALUES ('$firstname', '$lastname', '$email', '$hashedPassword', '$role')";

            if ($conn->query($sql) === TRUE) {
                header("Location: login.php?success=1");
                exit();
            } else {
                $registerMsg = "❌ Error: " . $conn->error;
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration form</title>
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
        </div>              
      </div>
    </div>
  </div>

  <!--  wraps the full form -->
  <div class="registration-form">

  

  <?php if (!empty($successMsg)): ?>
  <p style="color: green;"><?php echo $successMsg; ?></p>
<?php endif; ?>

    <h2>Registration</h2>

    <form method="POST" action="signup.php">
      <input type="text" name="firstname" placeholder="First name" required>
      <input type="text" name="lastname" placeholder="Last name" required>

      <div class="input-field">
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="input-field">
        <input type="password" name="password" placeholder="Password" required>
        <i class='bx bxs-low-vision visibility-toggle' style='color:#5d5d59'></i>
      </div>

      <div class="input-field">
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <i class='bx bxs-low-vision visibility-toggle' style='color:#5d5d59'></i>
      </div>

      <div class="input-field">
        <select name="role" required>
          <option value="">--Select Role--</option>
          <option value="customer">Customer</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button type="submit" class="btn">Create Account</button><br><br>
      <p>Already have an account? <a href="login.php">Login Here</a></p>
    </form>
  </div>

  <script src="main.js"></script>
</body>
</html>

 
