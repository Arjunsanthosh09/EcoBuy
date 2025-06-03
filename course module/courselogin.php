<?php
    include '../Config/connection.php';
    session_start();
    
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        echo "Email: " . $email . "<br>";
        
        $sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
        echo "SQL Query: " . $sql . "<br>";
        
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die("Query failed: " . mysqli_error($con));
        }
        
        echo "Number of rows found: " . mysqli_num_rows($result) . "<br>";
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
           
            echo "Role found: " . $row['role'] . "<br>";
            
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id'];
            
            if($row['role'] == 'course_taker') {
                header("Location: coursetakerhomepage.php");
                exit();
            } else if($row['role'] == 'user') {
                header("Location: studentscourseHomepage.php");
                exit();
            }
        } else {
            $error = "Invalid email or password";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBuy - Course Login</title>
    <link rel="stylesheet" href="../css/course.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
        .login-section {
            min-height: 100vh;
            display: flex;
            margin-top: 60px;
        }

        .login-image {
            flex: 1;
            background-image: url('../images/home/Rectangle 1441.png');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: white;
            text-align: center;
        }

        .login-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%);
        }

        .image-content {
            position: relative;
            z-index: 1;
            max-width: 500px;
        }

        .image-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        .image-content p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .login-form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: white;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            animation: slideInUp 0.5s ease-out;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #2563eb;
            outline: none;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 1.5rem;
        }

        .forgot-password a {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            color: #2563eb;
        }

        .login-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(45deg, #2563eb, #1d4ed8);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .register-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="../ecobuycourse.php" class="logo">
                <i class="fas fa-leaf"></i>
                EcoBuy
            </a>
            <ul class="nav-links">
                <li><a href="../ecobuycourse.php">Home</a></li>
                <li><a href="../ecobuycourse.php#courses">Courses</a></li>
                <li><a href="../ecobuycourse.php#certifications">Certifications</a></li>
                <li><a href="../ecobuycourse.php#about">About</a></li>
                <li><a href="../ecobuycourse.php#contact">Contact</a></li>
            </ul>
            <i class="fas fa-bars mobile-menu"></i>
        </div>
    </nav>
    <section class="login-section">
        <div class="login-image">
            <div class="image-content">
                <h2>Welcome to EcoBuy Learning</h2>
                <p>Join our community of experts and enhance your skills in product verification and quality assessment.</p>
            </div>
        </div>
        <div class="login-form-section">
            <div class="login-container">
                <h2>Welcome Back!</h2>
                <form action="" method="POST">
                    <?php if(isset($error)) { ?>
                        <div style="color: red; margin-bottom: 15px; text-align: center;"><?php echo $error; ?></div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required placeholder="Enter your password">
                    </div>
                    <div class="forgot-password">
                        <a href="forgot_password.php">Forgot Password?</a>
                    </div>
                    <button type="submit" name="submit" class="login-btn">Login</button>
                    <div class="register-link">
                        Don't have an account? <a href="register.php">Register Now</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        const mobileMenu = document.querySelector('.mobile-menu');
        const navLinks = document.querySelector('.nav-links');

        mobileMenu.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>
</body>
</html>