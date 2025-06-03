<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBuy - Sustainable Marketplace</title>
    <link rel="stylesheet" href="css/starter.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Hero section animations
        gsap.from('.hero-title', {
            opacity: 0,
            y: 50,
            duration: 1,
            delay: 0.5
        });

        gsap.from('.search-container', {
            opacity: 0,
            y: 30,
            duration: 1,
            delay: 0.8
        });

        // Features animations
        gsap.from('.feature', {
            scrollTrigger: {
                trigger: '.features-container',
                start: 'top center'
            },
            opacity: 0,
            y: 50,
            duration: 0.8,
            stagger: 0.2
        });

        // Product card animations
        gsap.from('.product-card', {
            scrollTrigger: {
                trigger: '.products-container',
                start: 'top center'
            },
            opacity: 0,
            y: 30,
            duration: 0.6,
            stagger: 0.15
        });

        // Experience section animation
        gsap.from('.experience-content', {
            scrollTrigger: {
                trigger: '.experience',
                start: 'top center'
            },
            opacity: 0,
            x: -50,
            duration: 1
        });

        gsap.from('.experience-image', {
            scrollTrigger: {
                trigger: '.experience',
                start: 'top center'
            },
            opacity: 0,
            x: 50,
            duration: 1
        });

        // Slider dots functionality
        const dots = document.querySelectorAll('.dot');
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                dots.forEach(d => d.classList.remove('active'));
                dot.classList.add('active');
            });
        });

        // Add to cart animation
        const cartButtons = document.querySelectorAll('.add-to-cart');
        cartButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                gsap.to(button, {
                    scale: 1.2,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 1
                });
                
                // Update cart count
                const cartCount = document.querySelector('.cart-count');
                cartCount.textContent = parseInt(cartCount.textContent) + 1;
                
                gsap.from(cartCount, {
                    scale: 1.5,
                    duration: 0.3
                });
            });
        });
    </script>
</head>

<body>
    <!-- Update the navbar section -->
    <nav class="navbar">
        <a href="index.php" class="logo">
            <img src="images/home/selling products/logooo.png" alt="EcoBuy Logo" class="logo-img">
        </a>
        <div class="nav-links">
        <a href="ecobuycourse.php">EcoBuy Course</a>
            <a href="#best-selling">Products</a>
            <a href="#best-selling">Shop</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="login.php">Login</a>
            <a href="registerselect.php">Register</a>
            <div class="nav-cart">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                    <path
                        d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                </svg>
                <span class="cart-count">0</span>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Buy Products More Secure & Trusrable</h1>
            <p class="hero-subtitle">Verified second-hand products | Eco-check before you buy | Trusted by 5K+ users</p>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search products...">
                <button class="search-btn">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                    </svg>
                </button>
            </div>
            <div class="slider-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    <section class="why-choose-us">
        <div class="why-title">
            <h2>Why</h2>
            <h2>Choosing Us</h2>
        </div>
        <div class="features-container">
            <div class="feature">
                <h3>♻️ Verified Sustainability</h3>
                <p>All products go through a rigorous checking process for quality and authenticity, ensuring they meet
                    eco-friendly standards.</p>
                <a href="#">More Info</a>
            </div>
            <div class="feature">
                <h3>💸 Affordable & Fair Pricing</h3>
                <p>Enjoy premium-quality second-hand items at prices that won’t break the bank — with transparency in
                    every deal.
                </p>
                <a href="#">More Info</a>
            </div>
            <div class="feature">
                <h3>🧠 Smart Product Choices</h3>
                <p>Browse from a wide range of pre-loved items — sorted by category, condition, price, and
                    sustainability score.</p>
                <a href="#">More Info</a>
            </div>
        </div>
    </section>
    <section class="best-selling" id="best-selling">
        <div class="section-header">
            <h2>Best Selling Product</h2>
            <div class="category-filters">
                <a href="#" class="active">Furniture</a>
                <a href="#">Mobile</a>
                <a href="#">Electronics</a>
                <a href="#">Vehicles</a>
            </div>
        </div>

        <div class="product-slider">
            <button class="slider-arrow prev">←</button>

            <div class="products-container">
                <div class="product-card" onclick="location.href='#best-selling'" style="cursor: pointer;">
                    <img src="images/home/selling products/Shop Kitchen & Dining Chairs - Copy.jpeg"
                        alt="Sakarias Armchair">
                    <div class="product-info">
                        <span class="category">Chair</span>
                        <h3>Sakarias Armchair</h3>
                        <div class="rating">
                            <span class="stars">★★★★★</span>
                        </div>
                        <div class="price-container">
                            <span class="price">$392</span>
                            <button class="add-to-cart">+</button>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <img src="images/home/selling products/iPhone 16 Pro.jpeg" alt="Baltsar Chair">
                    <div class="product-info">
                        <span class="category">Iphone</span>
                        <h3>Iphone 16 pro Max</h3>
                        <div class="rating">
                            <span class="stars">★★★★★</span>
                        </div>
                        <div class="price-container">
                            <span class="price">$75,000</span>
                            <button class="add-to-cart">+</button>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <img src="images/home/selling products/Washing machine PNG image with transparent background.jpeg"
                        alt="Anjay Chair">
                    <div class="product-info">
                        <span class="category">Washing Machine</span>
                        <h3>Lg Washing Machine</h3>
                        <div class="rating">
                            <span class="stars">★★★★★</span>
                        </div>
                        <div class="price-container">
                            <span class="price">$2000</span>
                            <button class="add-to-cart">+</button>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <img src="images/home/selling products/Hero Smart Fit 26T Fat tyre MTB_City Cycle _ 21 Speed Shimano Gears with Front Suspension and Dual disc Brakes _ Navy Blue _Ideal Age 12+ Years for Men and Women.jpeg"
                        alt="Nyantuy Chair">
                    <div class="product-info">
                        <span class="category">Cycle</span>
                        <h3>Gear Cycle</h3>
                        <div class="rating">
                            <span class="stars">★★★★★</span>
                        </div>
                        <div class="price-container">
                            <span class="price">$8500</span>
                            <button class="add-to-cart">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <button class="slider-arrow next">→</button>
        </div>

        <div class="view-all">
            <a href="#">View All →</a>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="experience">
        <div class="experience-container">
            <div class="experience-image">
                <img src="images/home/selling products/New California Bill Attempts to Tackle Fashion's Textile Waste — Sustainably Chic.jpeg"
                    alt="Modern Interior Design">
            </div>
            <div class="experience-content">
                <span class="experience-tag">EXPERIENCES</span>
                <h2>We Provide You a Reliable & Eco-Friendly Shopping Experience</h2>
                <p>At EcoBuy, we combine trust, transparency, and sustainability. Every item listed is carefully
                    verified by professionals, ensuring it meets quality and condition standards. Whether it’s a modern
                    piece or a vintage find, you can count on:

                    Expert-verified product inspections

                    Authentic condition ratings

                    Eco-conscious product sourcing

                    Elegant style at second-hand prices

                    You’re not just shopping — you’re making a difference.
                </p>
                <a href="#" class="more-info">More Info <span class="arrow">→</span></a>
            </div>
        </div>
    </section>

    <!-- Materials Section -->
    <section class="materials">
        <div class="materials-content">
            <span class="materials-tag">PRODUCTS</span>
            <h2>Quality You Can Trust, Sustainability You Can Feel</h2>
            <p>At EcoBuy, we believe that pre-owned doesn't mean lower quality. Every item listed is carefully inspected
                and verified for material strength, usability, and longevity by our trained checkers.

                We promote a circular economy — giving premium materials like solid wood, metal, glass, and durable
                plastics a second life.</p>
            <P>Why buy new when you can buy smart and sustainable?</P>
            <a href="#" class="more-info">More Info <span class="arrow">→</span></a>
        </div>
        <div class="materials-gallery">
            <div class="gallery-image small">
                <img src="images/home/selling products/Premium Photo _ Online fashion shopping collage.jpeg"
                    alt="Modern Chair Design">
            </div>
            <div class="gallery-image medium">
                <img src="images/home/selling products/How to Start a Profitable E-Commerce Business in 2025.jpeg"
                    alt="Sofa Design">
            </div>
            <div class="gallery-image large">
                <img src="images/home/selling products/Comment choisir la meilleure plateforme e-commerce pour votre entreprise et dominer le monde du digital.jpeg"
                    alt="Dining Set">
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="testimonials-header">
            <span class="testimonials-tag">TESTIMONIALS</span>
            <h2>Our Client Reviews</h2>
        </div>

        <div class="testimonials-container">
            <div class="testimonial-card">
                <img src="images/home/selling products/download (18).jpeg" alt="Client Review">
                <div class="testimonial-profile">
                    <img src="images/home/selling products/@ynt_barbi.jpeg" alt="Bang Upin" class="avatar">
                    <div class="profile-info">
                        <h3>Anjali Varghese</h3>
                        <span class="designation">Student | Kochi</span>
                    </div>
                </div>
                <p class="testimonial-text">"EcoBuy helped me furnish my hostel room affordably — everything looked
                    great and was eco-friendly! "
                </p>
                <div class="rating">
                    <span class="stars">★★★★☆</span>
                </div>
            </div>

            <div class="testimonial-card">
                <img src="images/home/selling products/Shagay_ann _ Дизайн _ Обучение.jpeg" alt="Client Review">
                <div class="testimonial-profile">
                    <img src="images/home/selling products/download (21).jpeg" alt="Ibuk Sukijan" class="avatar">
                    <div class="profile-info">
                        <h3>Amina Rahman</h3>
                        <span class="designation">Homemaker | Calicut</span>
                    </div>
                </div>
                <p class="testimonial-text">"Loved the service! The items were verified and in great condition. I saved
                    money and helped the environment."</p>
                <div class="rating">
                    <span class="stars">★★★★☆</span>
                </div>
            </div>

            <div class="testimonial-card">
                <img src="images/home/selling products/3d happy field.jpeg" alt="Client Review">
                <div class="testimonial-profile">
                    <img src="images/home/selling products/download (22).jpeg" alt="Mpok Ina" class="avatar">
                    <div class="profile-info">
                        <h3> Farzana Ahamed</h3>
                        <span class="designation">Marketing Executive | Kochi</span>
                    </div>
                </div>
                <p class="testimonial-text">"I love that I can buy stylish pre-owned items and still stay eco-conscious. The inspection process is so reassuring."</p>
                <div class="rating">
                    <span class="stars">★★★★☆</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <h3>EcoBuy</h3>
                <p>The advantage of buying eco-friendly products with us is that you get sustainable and high-quality
                    items while contributing to environmental conservation.</p>
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
</body>

</html>
<script src="js/cursor-effect.js"></script>