<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'course_taker') {
    header('Location: courselogin.php');
    exit();
}

require_once('../Config/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Course - EcoBuy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        .upload-form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
            width: 100%;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .test-section {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
        }

        .test-section textarea {
            min-height: 100px;
            resize: vertical;
        }

        .test-section input,
        .test-section select {
            margin-bottom: 0.75rem;
        }

        @media (max-width: 768px) {
            .upload-form-container {
                margin: 1rem;
                padding: 1rem;
            }

            .form-group input,
            .form-group textarea,
            .form-group select {
                font-size: 16px; /* Prevents zoom on mobile */
            }
        }

        .page-decorations {
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .decoration-left,
        .decoration-right {
            position: fixed;
            width: 300px;
            height: auto;
            opacity: 0.8;
            animation: float 6s ease-in-out infinite;
        }

        .decoration-left {
            left: -50px;
            top: 20%;
        }

        .decoration-right {
            right: -50px;
            top: 20%;
            animation-delay: -3s;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .decoration-left,
        .decoration-right {
            position: absolute;
            width: 300px;
            opacity: 0.1;
        }

        .decoration-left {
            left: 5%;
            top: 50%;
            transform: translateY(-50%);
        }

        .decoration-right {
            right: 5%;
            top: 50%;
            transform: translateY(-50%) scaleX(-1);
        }

        @media (max-width: 1400px) {
            .decoration-left,
            .decoration-right {
                width: 200px;
            }
        }

        @media (max-width: 1200px) {
            .decoration-left,
            .decoration-right {
                display: none;
            }
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
            min-height: calc(100vh - 80px - 400px);
        }

        .upload-form-container {
            max-width: 800px;
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            position: relative;
            overflow: hidden;
        }

        .upload-form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .form-header h1 {
            color: #1e293b;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #64748b;
            font-size: 1.1rem;
        }

        .form-icon {
            width: 64px;
            height: 64px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: #2563eb;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 2.5rem;
            color: #64748b;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="url"],
        .form-group select {
            padding-left: 2.5rem;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .form-group label i {
            position: static;
            font-size: 1rem;
            color: #2563eb;
        }

        .form-row {
            display: flex;
            gap: 1rem;
        }

        .form-group.half {
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #1e293b;
        }

        input[type="text"],
        input[type="number"],
        input[type="url"],
        textarea,
        select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .video-section, .test-section {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            position: relative;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .video-section:hover, .test-section:hover {
            border-color: #2563eb;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
        }

        .video-section::before {
            content: '📹';
            position: absolute;
            top: -10px;
            left: -10px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e8f0;
            font-size: 12px;
        }

        .test-section::before {
            content: '📝';
            position: absolute;
            top: -10px;
            left: -10px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e8f0;
            font-size: 12px;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #1e293b;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-secondary i {
            font-size: 1rem;
            color: #2563eb;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        .remove-section {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: #ef4444;
            color: white;
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .submit-btn {
            background: #2563eb;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            background: #1d4ed8;
        }

        /* Navbar Styles */
        .navbar {
            background: white;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: #1e293b;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #2563eb;
            background: #f1f5f9;
        }

        .nav-btn {
            background: #2563eb;
            color: white !important;
        }

        .nav-btn:hover {
            background: #1d4ed8 !important;
            color: white !important;
        }

        /* Footer Styles */
        .footer {
            background: white;
            padding: 4rem 0 0;
            margin-top: 4rem;
            box-shadow: 0 -2px 20px rgba(0,0,0,0.1);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .footer-section h3 {
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section ul a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul a:hover {
            color: #2563eb;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
        }

        .social-icons a {
            color: #64748b;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #2563eb;
        }

        .footer-bottom {
            margin-top: 3rem;
            padding: 1.5rem 0;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .footer-bottom-links {
            margin-top: 1rem;
        }

        .footer-bottom-links a {
            color: #64748b;
            text-decoration: none;
            margin: 0 1rem;
            font-size: 0.875rem;
        }

        .footer-bottom-links a:hover {
            color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="page-decorations">
        <img src="../images/home/bg11.png" alt="" class="decoration-left">
        <img src="../images/home/Anglan_Shop-removebg-preview.png" alt="" class="decoration-right">
    </div>

    <nav class="navbar">
        <div class="nav-container">
            <a href="../ecobuycourse.php" class="logo">
                <img src="../images/home/EcoBuy Logo.png" alt="EcoBuy Logo">
            </a>
            <div class="nav-links">
                <a href="coursetakerhomepage.php">Dashboard</a>
                <a href="courseupload.php" class="active">Course Upload</a>
                <a href="testmanagement.php">Tests</a>
                <a href="certificatemanagement.php">Certificates</a>
                <a href="../logout.php" class="nav-btn">Logout</a>
            </div>
            <i class="fas fa-bars mobile-menu"></i>
        </div>
    </nav>

    <div class="dashboard">
        <div class="upload-form-container">
            <div class="form-header">
                <div class="form-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1>Upload New Course</h1>
                <p>Create an engaging course for your students</p>
            </div>
            <form action="process_course_upload.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="course_title"><i class="fas fa-book"></i> Course Title</label>
                    <input type="text" id="course_title" name="course_title" maxlength="150" placeholder="Enter course title" required>
                    <i class="fas fa-heading input-icon"></i>
                </div>
                
                <div class="form-group">
                    <label for="course_description"><i class="fas fa-align-left"></i> Course Description</label>
                    <textarea id="course_description" name="course_description" rows="4" placeholder="Describe your course content and objectives" required></textarea>
                </div>

                <div class="form-group">
                    <label for="specialization"><i class="fas fa-tag"></i> Specialization</label>
                    <select id="specialization" name="specialization_id" required>
                        <option value="">Select Specialization</option>
                        <?php
                        $sql = "SELECT id, name FROM specializations ORDER BY name";
                        $result = $con->query($sql);
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='". $row['id'] ."'>". htmlspecialchars($row['name']) ."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label for="duration"><i class="fas fa-clock"></i> Duration (in months)</label>
                        <input type="number" id="duration" name="duration_in_months" min="1" required>
                    </div>
                    
                    <div class="form-group half">
                        <label for="class_hours"><i class="fas fa-hourglass-half"></i> Total Class Hours</label>
                        <input type="number" id="class_hours" name="class_hours" min="1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="course_rate"><i class="fas fa-rupee-sign"></i> Course Rate (₹)</label>
                    <input type="number" id="course_rate" name="course_rate" min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-video"></i> Course Videos</label>
                    <div id="video-sections">
                        <div class="video-section">
                            <input type="text" name="video_titles[]" placeholder="Video Title" maxlength="150" required>
                            <input type="url" name="youtube_links[]" placeholder="YouTube Link" required>
                            <input type="number" name="video_orders[]" placeholder="Order" min="1" required>
                        </div>
                    </div>
                    <button type="button" onclick="addVideoSection()" class="btn-secondary">Add More Videos</button>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-tasks"></i> Course Tests</label>
                    <div id="test-sections">
                        <div class="test-section">
                            <textarea name="questions[]" placeholder="Test Question" required></textarea>
                            <input type="text" name="option_a[]" placeholder="Option A" maxlength="100" required>
                            <input type="text" name="option_b[]" placeholder="Option B" maxlength="100" required>
                            <input type="text" name="option_c[]" placeholder="Option C" maxlength="100" required>
                            <input type="text" name="option_d[]" placeholder="Option D" maxlength="100" required>
                            <select name="correct_options[]" required>
                                <option value="">Select Correct Answer</option>
                                <option value="A">Option A</option>
                                <option value="B">Option B</option>
                                <option value="C">Option C</option>
                                <option value="D">Option D</option>
                            </select>
                            <button type="button" class="remove-section" onclick="removeSection(this)">×</button>
                        </div>
                    </div>
                    <button type="button" class="btn-secondary" onclick="addTestSection()"><i class="fas fa-plus-circle"></i> Add More Questions</button>
                </div>
                
                
                
                <button type="submit" class="submit-btn">Upload Course</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="coursetakerhomepage.php">Dashboard</a></li>
                    <li><a href="courseupload.php">Upload Course</a></li>
                    <li><a href="testmanagement.php">Manage Tests</a></li>
                    <li><a href="certificatemanagement.php">Certificates</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Documentation</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Teaching Tips</a></li>
                    <li><a href="#">Course Guidelines</a></li>
                    <li><a href="#">Best Practices</a></li>
                    <li><a href="#">Instructor Community</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 EcoBuy Course Platform. All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
    </footer>

    <script>
        function addVideoSection() {
            const container = document.getElementById('video-sections');
            const section = document.createElement('div');
            section.className = 'video-section';
            section.innerHTML = `
                <input type="text" name="video_titles[]" placeholder="Video Title" maxlength="150" required>
                <input type="url" name="youtube_links[]" placeholder="YouTube Link" required>
                <input type="number" name="video_orders[]" placeholder="Order" min="1" required>
                <button type="button" class="remove-section" onclick="removeSection(this)">×</button>
            `;
            container.appendChild(section);
        }

        function addTestSection() {
            const container = document.getElementById('test-sections');
            const section = document.createElement('div');
            section.className = 'test-section';
            section.innerHTML = `
                <textarea name="questions[]" placeholder="Test Question" required></textarea>
                <input type="text" name="option_a[]" placeholder="Option A" maxlength="100" required>
                <input type="text" name="option_b[]" placeholder="Option B" maxlength="100" required>
                <input type="text" name="option_c[]" placeholder="Option C" maxlength="100" required>
                <input type="text" name="option_d[]" placeholder="Option D" maxlength="100" required>
                <select name="correct_options[]" required>
                    <option value="">Select Correct Answer</option>
                    <option value="A">Option A</option>
                    <option value="B">Option B</option>
                    <option value="C">Option C</option>
                    <option value="D">Option D</option>
                </select>
                <button type="button" class="remove-section" onclick="removeSection(this)">×</button>
            `;
            container.appendChild(section);
        }

        function removeSection(button) {
            button.parentElement.remove();
        }
    </script>
</body>
</html>
