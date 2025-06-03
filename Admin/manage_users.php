<?php
include '../Config/connection.php';
session_start();

if (!isset($_SESSION['user_id']) ) {
    header('Location: ../login.php');
    exit;
}

$stmt = $con->prepare("SELECT id, name, email, role FROM login where role='user'");
$stmt->execute();
$result = $stmt->get_result();

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$stmt->close();
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - EcoBuy Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .user-table-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-top: 30px;
        }

        .user-table-container h2 {
            font-size: 24px;
            color: #d35400;
            margin-top: 0;
            margin-bottom: 25px;
            font-weight: 700;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .user-table th,
        .user-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .user-table th {
            background-color: #f8f8f8;
            color: #555;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }

        .user-table tbody tr:hover {
            background-color: #fdf5e6; /* Light orange on hover */
        }

        .user-table td {
            color: #333;
            font-size: 15px;
        }

        .user-table .action-buttons button {
            background-color: #e67e22; /* Orange button */
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
            transition: background-color 0.3s ease;
        }

        .user-table .action-buttons button:hover {
            background-color: #d35400; /* Darker orange on hover */
        }

        .user-table .action-buttons .delete-btn {
            background-color: #e74c3c;
        }

        .user-table .action-buttons .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <div class="dashboard-header">
            <h1>Manage Users</h1>
            <span class="date"><?php echo date('F j, Y'); ?></span>
        </div>

        <div class="user-table-container">
            <h2>All Users</h2>
            <?php if (empty($users)): ?>
                <p>No users found.</p>
            <?php else: ?>
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['role']); ?></td>
                                <td class="action-buttons">
                                    <button>Edit</button>
                                    <button class="delete-btn">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>