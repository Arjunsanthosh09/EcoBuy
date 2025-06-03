<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBuy - Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            background: #f5f5f5;
        }

        .container {
            display: flex;
            width: 120%;
            height: 100vh;
        }

        .background-section {
            flex: 1;
            background-image: url('images/home/Rectangle 1441.png');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .background-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 15%;
            height: 100%;
            background: linear-gradient(to right, transparent, white);
        }

        .registration-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: white;
        }

        .registration-options {
            display: flex;
            flex-direction: column;
            gap: 30px;
            width: 100%;
            max-width: 400px;
        }

        .option-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: visible;
        }

        .option-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .option-card:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .option-card:hover img {
            transform: scale(1.4) translateX(-20px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        .option-content {
            flex: 1;
        }

        .option-content h3 {
            color: #333;
            margin-bottom: 5px;
        }

        .option-content p {
            color: #666;
            font-size: 0.9em;
            line-height: 1.4;
        }

        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            z-index: 100;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-cart {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #FF5722;
            color: white;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo">
            <img src="images/home/selling products/logooo.png" alt="EcoBuy Logo" height="80px">
        </a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="login.php">Login</a>
            <a href="registerselect.php">Register</a>
            <div class="nav-cart">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="#333">
                    <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                </svg>
                <span class="cart-count">0</span>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="background-section"></div>
        <div class="registration-section">
            <div class="registration-options">
                <div class="option-card" onclick="window.location.href='userreg.php'">
                    <img src="images/regsiterpage/user.png" alt="User Registration">
                    <div class="option-content">
                        <h3>User Registration</h3>
                        <p>Register as a buyer or seller to start trading eco-friendly products</p>
                    </div>
                </div>

               
            </div>
        </div>
    </div>
</body>
</html>
<script src="js/cursor-effect.js"></script>