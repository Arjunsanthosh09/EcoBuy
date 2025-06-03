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
    <title>Certificate Management - EcoBuy</title>
    <link rel="stylesheet" href="../css/course.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</head>
<body>
    <div class="dashboard">
        <div class="certificate-container">
            <h1>Certificate Management</h1>
            
            <div class="certificate-options">
                <div class="certificate-template">
                    <h2>Certificate Template</h2>
                    <form action="update_certificate_template.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="template_image">Template Background</label>
                            <input type="file" id="template_image" name="template_image" accept="image/*">
                        </div>
                        
                        <div class="form-group">
                            <label for="certificate_text">Certificate Text</label>
                            <textarea id="certificate_text" name="certificate_text" rows="4">This is to certify that [Student Name] has successfully completed the course [Course Name] on [Completion Date]</textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">Update Template</button>
                    </form>
                </div>
                
                <div class="issued-certificates">
                    <h2>Issued Certificates</h2>
                    <?php
                    $instructor_id = $_SESSION['user_id'];
                    $sql = "SELECT c.*, s.name as student_name, co.title as course_name 
                           FROM certificates c 
                           JOIN students s ON c.student_id = s.id 
                           JOIN courses co ON c.course_id = co.id 
                           WHERE co.instructor_id = ?
                           ORDER BY c.issue_date DESC";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("i", $instructor_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    while($cert = $result->fetch_assoc()) {
                        echo '<div class="certificate-item">';
                        echo '<div class="cert-details">';
                        echo '<h3>' . htmlspecialchars($cert['student_name']) . '</h3>';
                        echo '<p>Course: ' . htmlspecialchars($cert['course_name']) . '</p>';
                        echo '<p>Issued: ' . date('F j, Y', strtotime($cert['issue_date'])) . '</p>';
                        echo '</div>';
                        echo '<div class="cert-actions">';
                        echo '<a href="view_certificate.php?id=' . $cert['id'] . '" class="btn-view">View</a>';
                        echo '<a href="download_certificate.php?id=' . $cert['id'] . '" class="btn-download">Download</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
