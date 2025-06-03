<?php
session_start();

// Check if user is logged in and is a course taker
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'course_taker') {
    header('Location: courselogin.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBuy - Course Taker Dashboard</title>
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 1.5rem;
            color: #1e293b;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .stat-card i {
            font-size: 2rem;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .quick-action-card i {
            font-size: 3rem;
            color: #1e293b;
            margin-bottom: 1rem;
            display: block;
        }

        .quick-action-card h3 {
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }

        .quick-action-card p {
            color: #64748b;
            margin-bottom: 1.5rem;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
            color: #1e293b;
        }

        .course-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            overflow: hidden;
            color: #1e293b;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .action-btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: #1e293b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .action-btn:hover {
            background: #0f172a;
            transform: translateY(-2px);
        }

        .recent-activity {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 1.5rem;
            color: #1e293b;
            margin-top: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(30, 41, 59, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-time {
            color: #64748b;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION['email']) || $_SESSION['role'] !== 'course_taker') {
            header("Location: courselogin.php");
            exit();
        }
    ?>
    <nav class="navbar">
        <div class="nav-container">
            <a href="../ecobuycourse.php" class="logo">
                <img src="../images/home/EcoBuy Logo.png" alt="EcoBuy Logo">
            </a>
            <div class="nav-links">
                <a href="coursetakerhomepage.php" class="active">Dashboard</a>
                <a href="managecourses.php">Manage Courses</a>
                <a href="analytics.php">Analytics</a>
                <a href="profile.php">Profile</a>
                <a href="../logout.php" class="nav-btn">Logout</a>
            </div>
            <i class="fas fa-bars mobile-menu"></i>
        </div>
    </nav>

    <div class="dashboard">
        <div class="welcome-section">
            <h1>Welcome back, <?php echo isset($_SESSION['email']) ? explode('@', $_SESSION['email'])[0] : 'Instructor'; ?>!</h1>
            <p>Manage your courses and track student progress from your dashboard.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <h3>1,234</h3>
                <p>Total Students</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-book"></i>
                <h3>12</h3>
                <p>Active Courses</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-star"></i>
                <h3>4.8</h3>
                <p>Average Rating</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-chart-line"></i>
                <h3>₹52,400</h3>
                <p>Monthly Revenue</p>
            </div>
        </div>

        <div class="actions-section">
            <h2>Quick Actions</h2>
            <div class="course-grid">
                <div class="course-card" style="padding: 2rem; text-align: center;">
                    <div class="quick-action-card">
                        <i class="fas fa-book-open"></i>
                        <h3>Course Management</h3>
                        <p>Manage your courses, content, and materials.</p>
                        <a href="courseupload.php" class="action-btn">Manage Courses</a>
                    </div>
                </div>
                <div class="course-card" style="padding: 2rem; text-align: center;">
                    <div class="quick-action-card">
                        <i class="fas fa-tasks"></i>
                        <h3>Test Management</h3>
                        <p>Create and manage course tests and assessments.</p>
                        <a href="testmanagement.php" class="action-btn">Manage Tests</a>
                    </div>
                </div>
                <div class="course-card" style="padding: 2rem; text-align: center;">
                    <div class="quick-action-card">
                        <i class="fas fa-certificate"></i>
                        <h3>Certificate Management</h3>
                        <p>Create and manage course completion certificates.</p>
                        <a href="certificatemanagement.php" class="action-btn">Manage Certificates</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="recent-activity">
            <h2>Recent Activity</h2>
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="activity-content">
                    <p><strong>New Enrollment</strong> - John Doe enrolled in "Advanced Eco-friendly Living"</p>
                    <span class="activity-time">2 hours ago</span>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-comment"></i>
                </div>
                <div class="activity-content">
                    <p><strong>New Review</strong> - 5-star rating received for "Sustainable Shopping Guide"</p>
                    <span class="activity-time">5 hours ago</span>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="activity-content">
                    <p><strong>Course Completion</strong> - 5 students completed "Basics of Recycling"</p>
                    <span class="activity-time">Yesterday</span>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="coursetakerhomepage.php">Dashboard</a></li>
                    <li><a href="managecourses.php">Manage Courses</a></li>
                    <li><a href="analytics.php">Analytics</a></li>
                    <li><a href="profile.php">Profile Settings</a></li>
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
                <h3>Resources</h3>
                <ul>
                    <li><a href="teachingguide.php">Teaching Guide</a></li>
                    <li><a href="community.php">Instructor Community</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="newsletter.php">Newsletter</a></li>
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

    <script>
        const mobileMenu = document.querySelector('.mobile-menu');
        const navLinks = document.querySelector('.nav-links');

        mobileMenu.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>
</body>
</html>