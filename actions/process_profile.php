<?php
session_start();
require_once '../config/db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];

    // 1. Fetch and Sanitize Text Inputs
    $country_code = $_POST['country_code'] ?? '';
    $phone = trim($_POST['phone'] ?? '');
    $full_phone = !empty($phone) ? $country_code . ' ' . $phone : NULL;

    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $postal_code = trim($_POST['postal_code'] ?? '');

    // 2. Education Logic
    $education_level = $_POST['education_level'] ?? NULL;
    $bs_status = NULL;
    $bs_year = NULL;

    // Agar BS select kiya hai tabhi status aur year save karein
    if ($education_level === 'bs') {
        $bs_status = $_POST['bs_status'] ?? NULL;
        $bs_year = $_POST['bs_year'] ?? NULL;
    }

    // 3. Image Upload Logic
    $profile_image = NULL; 
    
    // Pehle existing image check karein taake overwrite na ho
    $stmt_img = $pdo->prepare("SELECT profile_image FROM users WHERE id = ?");
    $stmt_img->execute([$user_id]);
    $existing_user = $stmt_img->fetch();
    $existing_image = $existing_user['profile_image'];

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../assets/images/profiles/';
        
        $file_tmp = $_FILES['profile_image']['tmp_name'];
        $file_name = $_FILES['profile_image']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($file_ext, $allowed_exts)) {
            // Unique naam banayein taake mix na ho (e.g., user_1_167890.jpg)
            $new_file_name = "user_" . $user_id . "_" . time() . "." . $file_ext;
            $dest_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $dest_path)) {
                $profile_image = $new_file_name;
            }
        }
    } else {
        $profile_image = $existing_image; // Agar nayi image nahi aayi toh purani wali hi save rakhein
    }

    // 4. Calculate Profile Completion Percentage dynamically
    $completion = 45; // Base 45% (Name, Email, Verified Account)
    if (!empty($full_phone)) $completion += 15;
    if (!empty($address) && !empty($city)) $completion += 20;
    if (!empty($education_level)) $completion += 10;
    if (!empty($profile_image)) $completion += 10;

    if ($completion > 100) $completion = 100; // Cap at 100%

    // 5. Update Database
    try {
        $sql = "UPDATE users SET 
                phone = ?, 
                address = ?, 
                city = ?, 
                postal_code = ?, 
                education_level = ?, 
                bs_status = ?, 
                bs_year = ?, 
                profile_image = ?, 
                profile_completion = ? 
                WHERE id = ?";
                
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $full_phone, $address, $city, $postal_code, 
            $education_level, $bs_status, $bs_year, 
            $profile_image, $completion, $user_id
        ]);

        $_SESSION['success_msg'] = "Profile updated successfully!";
        header("Location: ../user/dashboard.php");
        exit();

    } catch (PDOException $e) {
        die("Error updating profile: " . $e->getMessage());
    }
} else {
    header("Location: ../user/dashboard.php");
    exit();
}
?>