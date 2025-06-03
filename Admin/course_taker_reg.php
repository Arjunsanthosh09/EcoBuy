<?php
include('../Config/connection.php');
require '../vendor/autoload.php';

$specializations = [];
$sql_specializations = "SELECT id, name FROM specializations ORDER BY name ASC";
$result_specializations = $con->query($sql_specializations);

if ($result_specializations->num_rows > 0) {
    while($row = $result_specializations->fetch_assoc()) {
        $specializations[] = $row;
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];
    $specialization_id = $_POST['specialization']; // Use specialization_id

    // Insert into login table
    $sql_login = "INSERT INTO login (name, email, password, role) VALUES(?, ?, ?, 'course_taker')";
    $stmt_login = $con->prepare($sql_login);
    $stmt_login->bind_param("sss", $name, $email, $pass);

    if ($stmt_login->execute()) {
        // Get the last inserted login_id
        $login_id = $con->insert_id;

        // Insert into course_takers table
        $sql_course_takers = "INSERT INTO course_takers (login_id, full_name, email, phone_number, address, specialization_id) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt_course_takers = $con->prepare($sql_course_takers);
        $stmt_course_takers->bind_param("issssi", $login_id, $name, $email, $phonenumber, $address, $specialization_id);

        if ($stmt_course_takers->execute()) {
            // Fetch specialization name for PDF and email
            $specialization_name = '';
            $sql_spec_name = "SELECT name FROM specializations WHERE id = ?";
            $stmt_spec_name = $con->prepare($sql_spec_name);
            $stmt_spec_name->bind_param("i", $specialization_id);
            $stmt_spec_name->execute();
            $stmt_spec_name->bind_result($specialization_name);
            $stmt_spec_name->fetch();
            $stmt_spec_name->close();

            // PDF Generation
            require_once('../vendor/setasign/fpdf/fpdf.php');
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Ecobuy Course Taker Registration Details', 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, "Name: $name", 0, 1);
            $pdf->Cell(0, 10, "Email: $email", 0, 1);
            $pdf->Cell(0, 10, "Password: $pass", 0, 1);
            $pdf->Cell(0, 10, "Phone Number: $phonenumber", 0, 1);
            $pdf->Cell(0, 10, "Address: $address", 0, 1);
            $pdf->Cell(0, 10, "Specialization: $specialization_name", 0, 1);
            $pdf->Output('F', '../temp/course_taker_details.pdf'); // Changed filename

            // Email Sending
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'ecobuywebsite@gmail.com';
                $mail->Password = 'azyk dzhw oyae orpw'; // Your generated App Password
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom('noreply@ecobuy.com', 'Ecobuy System');
                $mail->addAddress($email, $name);
                $mail->isHTML(true);
                $mail->Subject = 'Your Ecobuy Course Taker Account Details';
                $mail->Body = "<h1>Welcome to Ecobuy!</h1>
                                   <p>Your course taker account has been created successfully.</p>
                                   <p>Email: $email</p>
                                   <p>Password: $pass</p>
                                   <p>Phone Number: $phonenumber</p>
                                   <p>Address: $address</p>
                                   <p>Specialization: $specialization_name</p>
                                   <p>Please find attached your registration details.</p>";
                $mail->addAttachment('../temp/course_taker_details.pdf'); // Changed filename
                $mail->send();
                $_SESSION['success'] = true;
                header("Location: course_taker_reg.php"); // Redirect to the same page
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error inserting into course_takers: " . $stmt_course_takers->error;
        }
        $stmt_course_takers->close();
    } else {
        echo "Error inserting into login: " . $stmt_login->error;
    }
    $stmt_login->close();
}
$con->close(); // Use $conn instead of $con
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/takerpassvalidation.js"></script>
    <link rel="stylesheet" href="../css/takerreg.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        .form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
    font-size: 16px;
    margin-top: 5px;
    margin-bottom: 15px;
}

.form-group select:focus {
    outline: none;
    border-color: #007bff; /* Highlight color on focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add a subtle shadow on focus */
}
    </style>
</head>

<body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <div class="header">
            <h1>Course Taker Registration</h1>
        </div>

        <?php if (isset($_SESSION['success']) && $_SESSION['success'] == 'true'): ?>
            <div class="success-message">
                Taker registered successfully!
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form action="#" method="post" class="taker-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required placeholder="Enter the email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        placeholder="Enter the password">
                    <span id="password-message" class="password-requirements"></span>
                </div>

                <div class="form-group">
                    <label for="phonenumber">Phone Number</label>
                    <input type="text" name="phonenumber" id="phonenumber" required placeholder="Enter the phonenumber">
                </div>
                <div class="form-group">
                    <label for="specialization">Specialization:</label>
                    <select id="specialization" name="specialization" required>
                        <option value="">Select Specialization</option>
                        <?php foreach ($specializations as $spec): ?>
                            <option value="<?php echo $spec['id']; ?>"><?php echo htmlspecialchars($spec['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" placeholder="Enter your address" required>
                </div>


                <button type="submit" name="submit" class="submit-btn">Register Taker</button>
            </form>
        </div>
    </div>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message">
            <i class="fas fa-check-circle"></i>
            Taker registered successfully! Details sent to email.
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
</body>

</html>
