<?php
include '../Config/connection.php';
require '../vendor/autoload.php'; 

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $location = $_POST['location'];
    $vehtype = $_POST['vehicletype'];
    $vehnum = $_POST['vehiclenumber'];
    $licnum = $_POST['licensenumber'];
    $sql = "INSERT INTO login (name, email, password, role) VALUES(?, ?, ?, 'taker')";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $pass);
    if ($stmt->execute()) {
        $taker_id = $stmt->insert_id;
        $sql2 = "INSERT INTO taker_details (taker_id,  current_location, vehicle_type, vehicle_number, license_number, availability_status) VALUES (?, ?, ?, ?, ?, 'available')";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bind_param("issss", $taker_id, $location, $vehtype, $vehnum, $licnum);
        if ($stmt2->execute()) {
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Ecobuy Taker Registration Details', 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, "Name: $name", 0, 1);
            $pdf->Cell(0, 10, "Email: $email", 0, 1);
            $pdf->Cell(0, 10, "Password: $pass", 0, 1);
            $pdf->Cell(0, 10, "Vehicle Type: $vehtype", 0, 1);
            $pdf->Output('F', '../temp/taker_details.pdf');
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
                $mail->Subject = 'Your Ecobuy Taker Account Details';
                $mail->Body = "<h1>Welcome to Ecobuy!</h1>
                                   <p>Your taker account has been created successfully.</p>
                                   <p>Email: $email</p>
                                   <p>Password: $pass</p>
                                   <p>Please find attached your registration details.</p>";
                $mail->addAttachment('../temp/taker_details.pdf');
                $mail->send();
                $_SESSION['success'] = true;
                header("Location: taker_registration.php");
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}
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
</head>

<body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <div class="header">
            <h1>Taker Registration</h1>
        </div>

        <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
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
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" required placeholder="Enter the location">
                </div>
                <div class="form-group">
                    <label for="vehicletype">Vehicle Type</label>
                    <input type="text" name="vehicletype" id="vehicletype" required placeholder="Enter the vehicle type">
                </div>
                <div class="form-group">
                    <label for="vehiclenumber">Vehicle Number</label>
                    <input
                        type="text"
                        name="vehiclenumber"
                        id="vehiclenumber"
                        required
                        placeholder="Enter the vehicle Number">
                    <span id="vehiclenumber-message" class="validation-message"></span>
                </div>
                <div class="form-group">
                    <label for="licensenumber">License Number</label>
                    <input
                        type="text"
                        name="licensenumber"
                        id="licensenumber"
                        required
                        placeholder="Enter the license Number">
                    <span id="licensenumber-message" class="validation-message"></span>
                </div>
                <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <select name="specialization" id="specialization" required>
                        <option value="">Select Specialization</option>
                        <?php foreach ($specializations as $spec): ?>
                            <option value="<?php echo $spec['id']; ?>"><?php echo $spec['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
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