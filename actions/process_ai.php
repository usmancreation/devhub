<?php
session_start();
require_once '../config/db_connect.php';

$user_id = $_SESSION['user_id'];
$cost_per_prompt = 5;

// 1. User ke credits check karein
$stmt = $pdo->prepare("SELECT credits FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($user['credits'] < $cost_per_prompt) {
    // Error: Credits nahi hain
    echo "Insufficient Credits! You need at least 5 credits to use this tool.";
    exit();
}

// 2. Yahan AI API ko hit karne ka code aayega...
// ...
// ...

// 3. AI se jawab aane ke baad, database se 5 credits kaat lein
$update_stmt = $pdo->prepare("UPDATE users SET credits = credits - ? WHERE id = ?");
$update_stmt->execute([$cost_per_prompt, $user_id]);

// 4. Session update kar dein taake Header mein minus ho jayein
$_SESSION['credits'] -= $cost_per_prompt;

// Success!
?>