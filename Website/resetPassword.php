<?php
session_start();

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newPassword = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Basic validation
    if (empty($newPassword) || empty($confirmPassword)) {
        $error = "Please fill in all fields.";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Passwords match — hash and save
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Simulate saving to the database
        // Example: You'd normally run an UPDATE query here
        // UPDATE users SET password = '$hashedPassword' WHERE email = ...

        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <div class="resetPassword-form">
            <?php if (!empty($error)): ?>
                <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($error); ?></p>
                <a href="reset-password.php" class="btn">Go Back</a>
            <?php elseif (!empty($success)): ?>
                <h2>Password Reset Successful 🎉</h2>
                <p>Your password has been updated.</p>
                <a href="login.php" class="btn">Login Now</a>
            <?php else: ?>
                <p>Invalid request. Please try again.</p>
                <a href="forgot-password.php" class="btn">Start Over</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
