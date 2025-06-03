<?php
session_start();
require_once('../Config/connection.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['email']) || $_SESSION['role'] !== 'course_taker') {
    header('Location: courselogin.php');
    exit();
}

try {
    $con->begin_transaction();

    $stmt = $con->prepare("SELECT id FROM course_takers WHERE email = ?");
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $course_taker = $result->fetch_assoc();
    
    if (!$course_taker) {
        throw new Exception("Course taker not found");
    }

    $stmt = $con->prepare("INSERT INTO courses (title, description, duration_in_months, class_hours, course_rate, specialization_id, course_taker_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiidi", 
        $_POST['course_title'],
        $_POST['course_description'],
        $_POST['duration_in_months'],
        $_POST['class_hours'],
        $_POST['course_rate'],
        $_POST['specialization_id'],
        $course_taker['id']
    );
    $stmt->execute();
    $course_id = $con->insert_id;
    if (isset($_POST['video_titles']) && isset($_POST['youtube_links'])) {
        $stmt = $con->prepare("INSERT INTO course_videos (course_id, video_title, youtube_link, video_order) VALUES (?, ?, ?, ?)");
        
        foreach ($_POST['video_titles'] as $index => $title) {
            $order = $index + 1;
            $link = $_POST['youtube_links'][$index];
            $stmt->bind_param("issi", $course_id, $title, $link, $order);
            $stmt->execute();
        }
    }
    if (isset($_POST['questions'])) {
        $stmt = $con->prepare("INSERT INTO course_tests (course_id, question, option_a, option_b, option_c, option_d, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        foreach ($_POST['questions'] as $index => $question) {
            $stmt->bind_param("issssss",
                $course_id,
                $question,
                $_POST['option_a'][$index],
                $_POST['option_b'][$index],
                $_POST['option_c'][$index],
                $_POST['option_d'][$index],
                $_POST['correct_options'][$index]
            );
            $stmt->execute();
        }
    }

    $con->commit();
    $_SESSION['success_message'] = "Course uploaded successfully!";
    header('Location: coursetakerhomepage.php');
    exit();

} catch (Exception $e) {
    $con->rollback();
    $_SESSION['error_message'] = "Error uploading course: " . $e->getMessage();
    header('Location: courseupload.php');
    exit();
}
?>
