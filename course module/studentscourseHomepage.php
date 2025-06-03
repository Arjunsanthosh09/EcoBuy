<?php
    session_start();
    if(!isset($_SESSION['email']) || $_SESSION['role'] !== 'user') {
        header("Location: courselogin.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBuy - Student Dashboard</title>
    <link rel="stylesheet" href="../css/course.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 0% 0%, rgba(37, 99, 235, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 100% 0%, rgba(37, 99, 235, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, rgba(37, 99, 235, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 0% 100%, rgba(37, 99, 235, 0.03) 0%, transparent 50%);
            z-index: -1;
        }

        body::after {
            content: '';
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80vw;
            height: 80vh;
            background: radial-gradient(circle at center, rgba(37, 99, 235, 0.02) 0%, transparent 70%);
            z-index: -1;
        }

        .dashboard {
            padding: 2rem;
            max-width: 1200px;
            margin: 80px auto 0;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
        }

        .welcome-section {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            padding: 2.5rem;
            border-radius: 20px;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1516321497487-e288fb19713f?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=300&w=300');
            background-size: cover;
            background-position: center;
            opacity: 0.1;
        }

        .welcome-section h1 {
            margin: 0;
            font-size: 2rem;
        }

        .welcome-section p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            pointer-events: none;
        }

        .stat-card i {
            font-size: 2rem;
            color: #1e293b;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .stat-card h3 {
            margin: 0;
            color: #333;
        }

        .stat-card p {
            margin: 0.5rem 0 0;
            color: #666;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .course-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .course-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            background-image: url('https://via.placeholder.com/600x400');
        }

        .course-content {
            padding: 1.5rem;
        }

        .course-content h3 {
            margin: 0;
            color: #333;
        }

        .course-content p {
            margin: 0.5rem 0;
            color: #666;
        }

        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .course-meta span {
            display: flex;
            align-items: center;
            color: #666;
        }

        .course-meta i {
            margin-right: 0.5rem;
            color: #2563eb;
        }

        .progress-bar {
            height: 6px;
            background: #eee;
            border-radius: 3px;
            margin-top: 1rem;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(45deg, #1e293b, #0f172a);
            border-radius: 3px;
        }

        .action-btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #1e293b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .action-btn:hover {
            background: #0f172a;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="../ecobuycourse.php" class="logo">
                <img src="../images/home/EcoBuy Logo.png" alt="EcoBuy Logo">
            </a>
            <div class="nav-links">
                <a href="studentscourseHomepage.php" class="active">Dashboard</a>
                <a href="mycourses.php">My Courses</a>
                <a href="profile.php">Profile</a>
                <a href="../logout.php" class="nav-btn">Logout</a>
            </div>
            <i class="fas fa-bars mobile-menu"></i>
        </div>
    </nav>

    <div class="dashboard">
        <div class="welcome-section">
            <h1>Welcome back, <?php echo isset($_SESSION['email']) ? explode('@', $_SESSION['email'])[0] : 'Student'; ?>! </h1>
            <p>Continue your learning journey with our exciting courses.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-book-open"></i>
                <h3>5</h3>
                <p>Courses in Progress</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-certificate"></i>
                <h3>3</h3>
                <p>Certificates Earned</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-clock"></i>
                <h3>28h</h3>
                <p>Learning Hours</p>
            </div>
        </div>

        <h2>Your Courses</h2>
        <div class="courses-grid">
            <div class="course-card">
                <div class="course-image" style="background-image: url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&w=600');"></div>
                <div class="course-content">
                    <h3>Sustainable Living Basics</h3>
                    <p>Learn the fundamentals of sustainable living and eco-friendly practices.</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: 75%;"></div>
                    </div>
                    <div class="course-meta">
                        <span><i class="fas fa-clock"></i> 75% Complete</span>
                        <a href="course.php?id=1" class="action-btn">Continue</a>
                    </div>
                </div>
            </div>

            <div class="course-card">
                <div class="course-image" style="background-image: url('https://images.unsplash.com/photo-1507925921958-8a62f3d1a50d?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&w=600');"></div>
                <div class="course-content">
                    <h3>Zero Waste Living</h3>
                    <p>Master the art of living without producing waste and helping the environment.</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: 30%;"></div>
                    </div>
                    <div class="course-meta">
                        <span><i class="fas fa-clock"></i> 30% Complete</span>
                        <a href="course.php?id=2" class="action-btn">Continue</a>
                    </div>
                </div>
            </div>

            <div class="course-card">
                <div class="course-image" style="background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=400&w=600');"></div>
                <div class="course-content">
                    <h3>Eco-Friendly Shopping</h3>
                    <p>Learn how to make sustainable choices while shopping for everyday items.</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: 15%;"></div>
                    </div>
                    <div class="course-meta">
                        <span><i class="fas fa-clock"></i> 15% Complete</span>
                        <a href="course.php?id=3" class="action-btn">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="studentscourseHomepage.php">Dashboard</a></li>
                    <li><a href="mycourses.php">My Courses</a></li>
                    <li><a href="profile.php">Profile Settings</a></li>
                    <li><a href="certificates.php">Certificates</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="help.php">Help Center</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="faq.php">FAQs</a></li>
                    <li><a href="feedback.php">Give Feedback</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Community</h3>
                <ul>
                    <li><a href="forum.php">Discussion Forum</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="news.php">Newsletter</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="app-badges">
                    <a href="#" class="app-badge">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" alt="Download on App Store">
                    </a>
                    <a href="#" class="app-badge">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play">
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 EcoBuy Learning. All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="privacy.php">Privacy Policy</a>
                <a href="terms.php">Terms of Service</a>
                <a href="sitemap.php">Sitemap</a>
            </div>
        </div>
    </footer>

    <style>
        .footer {
            margin-top: 4rem;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.8);
            padding: 4rem 2rem 1rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-section h3 {
            color: #1e293b;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin-bottom: 0.8rem;
        }

        .footer-section ul a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul a:hover {
            color: #1e293b;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .social-links a {
            color: #64748b;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #1e293b;
        }

        .app-badges {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .app-badge img {
            height: 40px;
            transition: opacity 0.3s ease;
        }

        .app-badge:hover img {
            opacity: 0.8;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 2rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        .footer-bottom p {
            margin: 0;
        }

        .footer-bottom-links {
            display: flex;
            gap: 2rem;
        }

        .footer-bottom-links a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-bottom-links a:hover {
            color: #1e293b;
        }

        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .footer-bottom-links {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .footer-content {
                grid-template-columns: 1fr;
            }

            .footer-section {
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }

            .app-badges {
                justify-content: center;
            }
        }
    </style>

    <script>
        const mobileMenu = document.querySelector('.mobile-menu');
        const navLinks = document.querySelector('.nav-links');

        mobileMenu.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>
</body>
</html>