<?php
    include 'Config/connection.php';
    session_start();
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id'];
            if($row['role'] == 'admin') {
                header("Location: admin/admindashboard.php");
            } else if($row['role'] == 'user') {
                header("Location: user/Homescreen.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBuy - Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="js/cursor-effect.js"></script>
</head>
<body>
    <!-- Navbar section -->
    <nav class="navbar">
        <a href="index.php" class="logo">
            <img src="images/home/selling products/logooo.png" alt="EcoBuy Logo" class="logo-img" height="80px">
        </a>
        <div class="nav-links">
           
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="login.php">Login</a>
            <a href="registerselect.php">Register</a>
            <div class="nav-cart">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                    <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                </svg>
                <span class="cart-count">0</span>
            </div>
        </div>
    </nav>

    <div class="login-container">
        <div class="login-image"></div>
        <div class="login-box">
            <h2>Welcome Back</h2>
            <form class="login-form" action="#" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-options">
                   
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>
                <button type="submit" name="submit" class="login-btn">Login</button>
            </form>
            <p class="signup-link">Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
    </div>
</body>
</html>