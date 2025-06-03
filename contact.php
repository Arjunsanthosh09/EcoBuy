<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - EcoBuy</title>
    <link rel="stylesheet" href="css/starter.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
</head>

<body>
    <nav class="navbar">
        <a href="index.php" class="logo">
            <img src="images/home/selling products/logooo.png" alt="EcoBuy Logo" class="logo-img">
        </a>
        <div class="nav-links">
            <a href="index.php#best-selling">Products</a>
            <a href="index.php#best-selling">Shop</a>
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

    <section class="contact-hero">
        <div class="contact-hero-content">
            <h1>Get in Touch</h1>
            <p>Have questions about sustainable shopping? We're here to help!</p>
        </div>
    </section>

    <section class="contact-info">
        <div class="contact-grid">
            <div class="contact-card">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Visit Us</h3>
                <p>123 Eco Street<br>Green Valley, Kerala<br>India 682001</p>
            </div>
            <div class="contact-card">
                <i class="fas fa-phone"></i>
                <h3>Call Us</h3>
                <p>+91 123 456 7890<br>+91 987 654 3210</p>
            </div>
            <div class="contact-card">
                <i class="fas fa-envelope"></i>
                <h3>Email Us</h3>
                <p>info@ecobuy.com<br>support@ecobuy.com</p>
            </div>
        </div>
    </section>

    <!-- Add this section after the contact-info section and before the contact-form section -->
    <section class="social-profiles">
        <h2>Follow Us</h2>
        <p>Stay connected with us on social media</p>
        <div class="social-grid">
            <div class="social-card youtube">
                <div class="social-icon">
                    <i class="fab fa-youtube"></i>
                </div>
                <div class="social-stats">
                    <h3>YouTube</h3>
                    <p>100K+ Subscribers</p>
                    <span class="social-handle">@ecobuy_official</span>
                </div>
                <a href="#" class="social-link">Subscribe</a>
            </div>
            
            <div class="social-card instagram">
                <div class="social-icon">
                    <i class="fab fa-instagram"></i>
                </div>
                <div class="social-stats">
                    <h3>Instagram</h3>
                    <p>50K+ Followers</p>
                    <span class="social-handle">@ecobuy</span>
                </div>
                <a href="#" class="social-link">Follow</a>
            </div>
            
            <div class="social-card facebook">
                <div class="social-icon">
                    <i class="fab fa-facebook"></i>
                </div>
                <div class="social-stats">
                    <h3>Facebook</h3>
                    <p>75K+ Likes</p>
                    <span class="social-handle">@ecobuysustainable</span>
                </div>
                <a href="#" class="social-link">Like</a>
            </div>
        </div>
    </section>

    <section class="contact-form">
        <div class="form-container">
            <h2>Send Us a Message</h2>
            <form id="contactForm">
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="text" id="subject" name="subject" placeholder="Subject" required>
                </div>
                <div class="form-group">
                    <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </section>

    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Hero section animations
        gsap.from('.contact-hero-content', {
            opacity: 0,
            y: 50,
            duration: 1,
            delay: 0.5
        });

        // Contact cards animation
        gsap.from('.contact-card', {
            scrollTrigger: {
                trigger: '.contact-info',
                start: 'top center'
            },
            opacity: 0,
            y: 30,
            duration: 0.6,
            stagger: 0.2
        });

        // Social cards animation
        gsap.from('.social-card', {
            scrollTrigger: {
                trigger: '.social-profiles',
                start: 'top center'
            },
            opacity: 0,
            y: 30,
            duration: 0.6,
            stagger: 0.2
        });

        // Form animation
        gsap.from('.form-container', {
            scrollTrigger: {
                trigger: '.contact-form',
                start: 'top center'
            },
            opacity: 0,
            y: 30,
            duration: 0.8
        });
    </script>
</body>

</html>