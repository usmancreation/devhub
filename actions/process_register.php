<?php
session_start();
// Database connection include karein (Path updated to config folder)
require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Data Sanitize and Fetch
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $referred_by = trim($_POST['referral_code']); 
    
    // 2. Basic Validation
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        die("Error: All fields are required.");
    }
    
    if ($password !== $confirm_password) {
        die("Error: Passwords do not match.");
    }

    // 3. Check if Email Already Exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        die("Error: Email address is already registered.");
    }

    // 4. Check Referral Code Validity (If provided)
    if (!empty($referred_by)) {
        $ref_stmt = $pdo->prepare("SELECT id FROM users WHERE referral_code = ?");
        $ref_stmt->execute([$referred_by]);
        if ($ref_stmt->rowCount() == 0) {
            $referred_by = NULL; // Invalid code ignore kar dein
        }
    } else {
        $referred_by = NULL;
    }

    // 5. Secure Data Generation
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $otp_code = rand(100000, 999999); // 6-digit OTP
    
    // Generate User's Referral Code (First 4 letters + 4 random digits)
    $name_prefix = strtoupper(substr(str_replace(' ', '', $full_name), 0, 4));
    $my_referral_code = $name_prefix . rand(1000, 9999);

    // Initial Credits (Business Logic)
    $initial_credits = 100;

    try {
        // 6. Insert User into Database (is_verified = 0)
        $insert_query = "INSERT INTO users (full_name, email, password_hash, credits, referral_code, referred_by, otp_code, is_verified) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
        
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->execute([
            $full_name, $email, $password_hash, $initial_credits, 
            $my_referral_code, $referred_by, $otp_code
        ]);

        // 7. Send OTP via Email (Basic PHP mail)
        $subject = "Your DevHub Verification Code";
        $message = "Your 6-digit verification code is: " . $otp_code;
        $headers = "From: no-reply@devhub.com";
        @mail($email, $subject, $message, $headers); // Localhost par mail fail ho sakti hai, isliye @ lagaya hai

        // 8. Redirect to OTP Verification Page
        $_SESSION['verify_email'] = $email;
        header("Location: ../auth/verify_otp.php");
        exit();

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
} else {
    header("Location: ../auth/register.php");
    exit();
}
?>