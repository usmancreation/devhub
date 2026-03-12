<?php
session_start();
require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = trim($_POST['email']);
    $entered_otp = trim($_POST['otp_code']);
    
    if (empty($email) || empty($entered_otp)) {
        die("Error: Invalid request.");
    }

    try {
        // Query mein 'full_name' add kiya gaya hai
        $stmt = $pdo->prepare("SELECT id, full_name, otp_code FROM users WHERE email = ? AND is_verified = 0");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && $user['otp_code'] == $entered_otp) {
            // Account verify karein
            $update_stmt = $pdo->prepare("UPDATE users SET is_verified = 1, otp_code = NULL WHERE email = ?");
            $update_stmt->execute([$email]);

            // Auto-login session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name']; // YEH MISSING THA!
            $_SESSION['success_msg'] = "Account verified successfully! You received 100 credits.";
            
            // Redirect direct dashboard par
            header("Location: ../user/dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid or expired Verification Code.";
            header("Location: ../auth/verify_otp.php");
            exit();
        }
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
} else {
    header("Location: ../auth/verify_otp.php");
    exit();
}
?>