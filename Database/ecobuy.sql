-- EcoBuy SQL Schema

CREATE DATABASE IF NOT EXISTS ecobuy;
USE ecobuy;

-- 1. Users Table
CREATE TABLE login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin', 'checker', 'taker', 'course_taker') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- 2. Products Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255),
    description TEXT,
    category VARCHAR(100),
    `condition` ENUM('good', 'fair', 'poor'),  
    price DECIMAL(10,2),
    location VARCHAR(255),
    image VARCHAR(255),
    status ENUM('pending', 'assigned', 'verified', 'approved', 'live', 'sold') DEFAULT 'pending',
    checker_id INT DEFAULT NULL,
    admin_id INT DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES login(id) ON DELETE CASCADE,
    FOREIGN KEY (checker_id) REFERENCES login(id),
    FOREIGN KEY (admin_id) REFERENCES login(id)
);

-- 3. Product Verifications Table
CREATE TABLE product_verifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    checker_id INT,
    `condition` ENUM('good', 'fair', 'poor'),  -- Added backticks around reserved keyword
    `rating` INT,  -- Added backticks and simplified the check constraint
    CHECK (`rating` BETWEEN 1 AND 5),  -- Separated check constraint
    notes TEXT,
    proof_image VARCHAR(255),
    verified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (checker_id) REFERENCES login(id)  -- Changed reference from users to login table
);

-- 4. Cart Table
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES login(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- 5. Orders Table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10,2),
    status ENUM('pending', 'approved', 'assigned', 'delivered', 'cancelled') DEFAULT 'pending',
    payment_status ENUM('unpaid', 'paid') DEFAULT 'unpaid',
    taker_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES login(id),
    FOREIGN KEY (taker_id) REFERENCES login(id)
);

-- 6. Order Items Table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10,2),
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- 7. Payments Table
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    payment_method VARCHAR(50),
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    paid_at TIMESTAMP NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- 8. Sample Admin
INSERT INTO login (name, email, password, role)
VALUES ('Admin', 'admin@ecobuy.com', 'admin123', 'admin');


-- User Details Table
CREATE TABLE user_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE,
    street_address TEXT NOT NULL,
    city VARCHAR(100) NOT NULL,
    state_province VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    area_name VARCHAR(100),
    area_pincode VARCHAR(20),
    landmark TEXT,
    fullname VARCHAR(100),
    gender ENUM('male', 'female', 'other'),
    profile_image VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES login(id) ON DELETE CASCADE
);

CREATE TABLE taker_details (
    taker_id INT PRIMARY KEY,
    availability_status ENUM('available', 'busy', 'offline') DEFAULT 'available',
    current_location VARCHAR(255),
    rating DECIMAL(3,2) DEFAULT 0,
    total_deliveries INT DEFAULT 0,
    vehicle_type VARCHAR(50),
    vehicle_number VARCHAR(20),
    license_number VARCHAR(50),
    FOREIGN KEY (taker_id) REFERENCES login(id) ON DELETE CASCADE
);

-- Delivery Details Table
CREATE TABLE delivery_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    taker_id INT,
    pickup_location VARCHAR(255),
    delivery_location VARCHAR(255),
    delivery_status ENUM('pending', 'picked_up', 'in_transit', 'delivered') DEFAULT 'pending',
    estimated_delivery_time DATETIME,
    actual_delivery_time DATETIME,
    delivery_notes TEXT,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (taker_id) REFERENCES login(id)
);

-- Checker Details Table
CREATE TABLE checker_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    checker_id INT UNIQUE,
    specialization VARCHAR(100),
    experience_years INT,
    rating DECIMAL(3,2) DEFAULT 0,
    total_verifications INT DEFAULT 0,
    availability_status ENUM('available', 'busy', 'offline') DEFAULT 'offline',
    current_location VARCHAR(255),
    certification_number VARCHAR(50),
    certification_expiry DATE,
    FOREIGN KEY (checker_id) REFERENCES login(id) ON DELETE CASCADE
);

-- certificate specialization

CREATE TABLE specializations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE
);

CREATE TABLE course_takers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login_id INT UNIQUE,
    full_name VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    phone_number VARCHAR(20),
    address TEXT,
    specialization_id INT,
    FOREIGN KEY (login_id) REFERENCES login(id),
    FOREIGN KEY (specialization_id) REFERENCES specializations(id)
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150),
    description TEXT,
    duration_in_months INT,
    class_hours INT,
    course_rate DECIMAL(10,2),
    specialization_id INT,
    course_taker_id INT,
    FOREIGN KEY (specialization_id) REFERENCES specializations(id),
    FOREIGN KEY (course_taker_id) REFERENCES course_takers(id)
);

CREATE TABLE course_videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    video_title VARCHAR(150),
    youtube_link VARCHAR(255),
    video_order INT,
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE video_progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    checker_id INT,
    video_id INT,
    watched BOOLEAN DEFAULT FALSE,
    watched_on DATETIME,
    FOREIGN KEY (checker_id) REFERENCES login(id),
    FOREIGN KEY (video_id) REFERENCES course_videos(id)
);

CREATE TABLE course_tests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    question TEXT,
    option_a VARCHAR(100),
    option_b VARCHAR(100),
    option_c VARCHAR(100),
    option_d VARCHAR(100),
    correct_option CHAR(1),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE test_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    checker_id INT,
    course_id INT,
    score INT,
    passed BOOLEAN,
    attempted_on DATETIME,
    FOREIGN KEY (checker_id) REFERENCES login(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    checker_id INT,
    course_id INT,
    certificate_number VARCHAR(100),
    issued_on DATE,
    expiry_date DATE,
    FOREIGN KEY (checker_id) REFERENCES login(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);
