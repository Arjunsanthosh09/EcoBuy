<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EcoBuy</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <div class="dashboard-header">
            <h1>Dashboard Overview</h1>
            <span class="date"><?php echo date('F j, Y'); ?></span>
        </div>

        <div class="card-container">
            <div class="card">
                <div class="card-content">
                    <h3>Total Users</h3>
                    <p>1,234</p>
                </div>
                <i class="fas fa-users card-icon"></i>
            </div>
            <div class="card">
                <div class="card-content">
                    <h3>Total Products</h3>
                    <p>567</p>
                </div>
                <i class="fas fa-box card-icon"></i>
            </div>
            <div class="card">
                <div class="card-content">
                    <h3>Pending Orders</h3>
                    <p>42</p>
                </div>
                <i class="fas fa-shopping-cart card-icon"></i>
            </div>
            <div class="card">
                <div class="card-content">
                    <h3>New Registrations</h3>
                    <p>15</p>
                </div>
                <i class="fas fa-user-plus card-icon"></i>
            </div>
        </div>

        <div class="recent-activity">
            <h2>Recent Activity</h2>
            <div class="activity-item">
                <i class="fas fa-user-check activity-icon"></i>
                <div class="activity-details">
                    <p>John Doe registered as a new user.</p>
                    <span class="time">2 hours ago</span>
                </div>
            </div>
            <div class="activity-item">
                <i class="fas fa-box activity-icon"></i>
                <div class="activity-details">
                    <p>New product 'Organic Apples' added.</p>
                    <span class="time">Yesterday</span>
                </div>
            </div>
            <div class="activity-item">
                <i class="fas fa-shopping-cart activity-icon"></i>
                <div class="activity-details">
                    <p>Order #1001 placed by Jane Smith.</p>
                    <span class="time">3 days ago</span>
                </div>
            </div>
        </div>

        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <button>Add New Product</button>
                <button>View All Orders</button>
                <button>Manage Takers</button>
            </div>
        </div>
    </div>
</body>
</html>