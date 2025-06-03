<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - EcoBuy</title>
    <link rel="stylesheet" href="css/starter.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
</head>
<body>
    <!-- Navbar Section -->
    <nav class="navbar">
        <a href="index.php" class="logo">
            <img src="images/home/selling products/logooo.png" alt="EcoBuy Logo" class="logo-img">
        </a>
        <div class="nav-links">
            <a href="index.php#best-selling">Products</a>
            <a href="index.php#best-selling">Shop</a>
            <a href="#">About Us</a>
            <a href="#">Contact</a>
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

    <!-- About Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content">
            <h1>About EcoBuy</h1>
            <p>Making Sustainable Shopping Accessible to Everyone</p>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="mission-section">
        <div class="mission-content">
            <h2>Our Mission</h2>
            <p>At EcoBuy, we're committed to revolutionizing the way people shop for second-hand items. Our platform combines sustainability with quality, ensuring that every purchase contributes to environmental conservation while maintaining high standards.</p>
            
            <div class="mission-values">
                <div class="value-card">
                    <i class="fas fa-leaf"></i>
                    <h3>Sustainability First</h3>
                    <p>Every item on our platform is carefully selected to meet our eco-friendly standards.</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-check-circle"></i>
                    <h3>Quality Assured</h3>
                    <p>Our expert checkers verify each product's condition and authenticity.</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-users"></i>
                    <h3>Community Driven</h3>
                    <p>Building a community of conscious consumers and responsible sellers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section class="team-section">
        <h2>Meet Our Team</h2>
        <div class="team-grid">
            <div class="team-member">
                <img src="images/home/selling products/@ynt_barbi.jpeg" alt="Team Member">
                <h3>Sarah Johnson</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <img src="images/home/selling products/download (21).jpeg" alt="Team Member">
                <h3>Michael Chen</h3>
                <p>Head of Sustainability</p>
            </div>
            <div class="team-member">
                <img src="images/home/selling products/download (22).jpeg" alt="Team Member">
                <h3>Emily Rodriguez</h3>
                <p>Lead Product Verifier</p>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section class="impact-section">
        <div class="impact-content">
            <h2>Our Impact</h2>
            <div class="impact-stats">
                <div class="stat-card">
                    <h3>5000+</h3>
                    <p>Happy Customers</p>
                </div>
                <div class="stat-card">
                    <h3>10000+</h3>
                    <p>Products Verified</p>
                </div>
                <div class="stat-card">
                    <h3>500+</h3>
                    <p>Tons CO2 Saved</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <h3>EcoBuy</h3>
                <p>The advantage of buying eco-friendly products with us is that you get sustainable and high-quality items while contributing to environmental conservation.</p>
            </div>

            <div class="footer-links">
                <div class="footer-section">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#">Sustainable Shopping</a></li>
                        <li><a href="#">Eco Consulting</a></li>
                        <li><a href="#">Green Living</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Products</h4>
                    <ul>
                        <li><a href="#">Eco Furniture</a></li>
                        <li><a href="#">Sustainable Decor</a></li>
                        <li><a href="#">All Products</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Follow Us</h4>
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>Copyright © 2024 EcoBuy</p>
            <div class="footer-legal">
                <a href="#">Terms & Conditions</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>

    <script src="js/cursor-effect.js"></script>
    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Animate mission values
        gsap.from('.value-card', {
            scrollTrigger: {
                trigger: '.mission-values',
                start: 'top center'
            },
            opacity: 0,
            y: 50,
            duration: 0.8,
            stagger: 0.2
        });

        // Animate team members
        gsap.from('.team-member', {
            scrollTrigger: {
                trigger: '.team-grid',
                start: 'top center'
            },
            opacity: 0,
            y: 30,
            duration: 0.6,
            stagger: 0.15
        });

        // Animate impact stats
        gsap.from('.stat-card', {
            scrollTrigger: {
                trigger: '.impact-stats',
                start: 'top center'
            },
            opacity: 0,
            y: 30,
            duration: 0.6,
            stagger: 0.15
        });
    </script>
</body>
</html>