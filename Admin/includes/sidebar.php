
<div class="sidebar">
    <div class="logo-details">
        <img src="../images/home/selling products/logooo.png" alt="EcoBuy Logo" class="logo-img">
        <span class="logo-name">EcoBuy Admin</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="admindashboard.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'admindashboard.php') ? 'active' : ''; ?>">
                <i class="fas fa-home"></i>
                <span class="link-name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="manage_users.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'manage_users.php') ? 'active' : ''; ?>">
                <i class="fas fa-users"></i>
                <span class="link-name">Manage Users</span>
            </a>
        </li>
        <li>
            <a href="taker_registration.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'taker_registration.php') ? 'active' : ''; ?>">
                <i class="fas fa-user-plus"></i>
                <span class="link-name">Taker Registration</span>
            </a>
        </li>
        <li>
            <a href="checker_registration.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'checker_registration.php') ? 'active' : ''; ?>">
                <i class="fas fa-user-check"></i>
                <span class="link-name">Checker Registration</span>
            </a>
        </li>
        <li>
            <a href="manage_products.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'manage_products.php') ? 'active' : ''; ?>">
                <i class="fas fa-box"></i>
                <span class="link-name">Manage Products</span>
            </a>
        </li>
        <li>
            <a href="manage_orders.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'manage_orders.php') ? 'active' : ''; ?>">
                <i class="fas fa-shopping-cart"></i>
                <span class="link-name">Manage Orders</span>
            </a>
        </li>
        <li>
            <a href="course_taker_reg.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'course_taker_reg.php') ? 'active' : ''; ?>">
                <i class="fas fa-graduation-cap"></i>
                <span class="link-name">Course Taker</span>
            </a>
        </li>
        <li class="logout-link">
            <a href="../logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span class="link-name">Logout</span>
            </a>
        </li>
    </ul>
</div>