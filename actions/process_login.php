<?php
session_start();
require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        die("Error: Email and Password are required.");
    }

    try {
        // Fetch User Data
        $stmt = $pdo->prepare("SELECT id, full_name, password_hash, is_verified, credits FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Verify Password
            if (password_verify($password, $user['password_hash'])) {
                
                // Check if account is verified
                if ($user['is_verified'] == 0) {
                    $_SESSION['verify_email'] = $email;
                    header("Location: ../auth/verify_otp.php"); // Agar verify nahi hai toh wapas OTP page par bhejo
                    exit();
                }

                // Login Success! Session create karein
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['credits'] = $user['credits'];
                
                // Redirect to Home page
                header("Location: ../index.php");
                exit();
                
            } else {
                die("Error: Incorrect Password.");
            }
        } else {
            die("Error: Email not found.");
        }
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
} else {
    header("Location: ../auth/login.php");
    exit();
}
?>