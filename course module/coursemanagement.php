<?php
session_start();

// Check if user is logged in and is a course taker
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
    <title>Course Management - EcoBuy</title>
    <link rel="stylesheet" href="../css/course.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</head>
<body>
    <div class="dashboard">
        <div class="management-container">
            <h1>Course Management</h1>
            
            <div class="course-tabs">
                <button class="tab-btn active" onclick="showTab('active')">Active Courses</button>
                <button class="tab-btn" onclick="showTab('draft')">Draft Courses</button>
                <button class="tab-btn" onclick="showTab('archived')">Archived Courses</button>
            </div>
            
            <div class="course-list" id="active-courses">
                <?php
                // Fetch active courses
                $instructor_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM courses WHERE instructor_id = ? AND status = 'active'";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $instructor_id);
                $stmt->execute();
                $result = $stmt->get_result();
                
                while($course = $result->fetch_assoc()) {
                    echo '<div class="course-item">';
                    echo '<img src="' . htmlspecialchars($course['thumbnail_url']) . '" alt="Course thumbnail">';
                    echo '<div class="course-details">';
                    echo '<h3>' . htmlspecialchars($course['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($course['description']) . '</p>';
                    echo '<div class="course-stats">';
                    echo '<span><i class="fas fa-users"></i> ' . $course['enrolled_count'] . ' Students</span>';
                    echo '<span><i class="fas fa-star"></i> ' . number_format($course['rating'], 1) . '</span>';
                    echo '</div>';
                    echo '<div class="course-actions">';
                    echo '<a href="edit_course.php?id=' . $course['id'] . '" class="btn-edit">Edit</a>';
                    echo '<a href="view_analytics.php?id=' . $course['id'] . '" class="btn-analytics">Analytics</a>';
                    echo '<button onclick="archiveCourse(' . $course['id'] . ')" class="btn-archive">Archive</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    
    <script>
    function showTab(tabName) {
        // Add tab switching logic
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        // Add AJAX call to load appropriate courses
    }
    
    function archiveCourse(courseId) {
        if(confirm('Are you sure you want to archive this course?')) {
            // Add AJAX call to archive course
        }
    }
    </script>
</body>
</html>
