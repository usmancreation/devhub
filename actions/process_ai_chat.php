<?php
session_start();
// Output ko JSON format mein set karein kyunke hum JS fetch() use kar rahe hain
header('Content-Type: application/json');

// Security: Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access. Please login.']);
    exit();
}

require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user_id = $_SESSION['user_id'];
    $prompt = trim($_POST['prompt'] ?? '');
    $cost_per_prompt = 5;

    // Check if prompt is empty
    if (empty($prompt)) {
        echo json_encode(['status' => 'error', 'message' => 'Prompt cannot be empty.']);
        exit();
    }

    try {
        // 1. Database se taza (fresh) credits check karein (Taake koi inspect element se cheat na kar sake)
        $stmt = $pdo->prepare("SELECT credits FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'User account not found.']);
            exit();
        }

        $current_credits = $user['credits'];

        // 2. Check agar credits kam hain
        if ($current_credits < $cost_per_prompt) {
            echo json_encode([
                'status' => 'error', 
                'message' => 'Insufficient credits. You need at least ' . $cost_per_prompt . ' credits per prompt.'
            ]);
            exit();
        }

        // =========================================================
        // 3. AI API LOGIC (Yahan OpenAI / Gemini ka real code aayega)
        // =========================================================
        
        // Asal API call ke time ke liye thora delay add kiya hai (1 sec) taake typing animation nazar aaye
        sleep(1); 
        
        // Dummy Response Format
        $ai_response = "Here is the response to your prompt: <strong>\"" . htmlspecialchars($prompt) . "\"</strong>.<br><br>";
        $ai_response .= "<em>[Developer Note: This is a simulated response. The credit deduction logic is fully functional. You can easily plug in the OpenAI/Gemini API here later.]</em><br><br>";
        $ai_response .= "<div class='bg-dark-bg p-3 rounded-lg border border-gray-700 font-mono text-xs text-green-400 mt-2'>// Example Code<br>echo 'Hello DevHub!';</div>";


        // =========================================================
        // 4. Deduct Credits from Database
        // =========================================================
        $new_credits = $current_credits - $cost_per_prompt;
        
        $update_stmt = $pdo->prepare("UPDATE users SET credits = ? WHERE id = ?");
        $update_stmt->execute([$new_credits, $user_id]);

        // 5. Update Session Variable (Taake header waghera mein bhi minus show ho)
        $_SESSION['credits'] = $new_credits;

        // 6. Send Success Response to Javascript
        echo json_encode([
            'status' => 'success',
            'response' => $ai_response,
            'new_credits' => $new_credits
        ]);
        exit();

    } catch (PDOException $e) {
        // Database Error
        echo json_encode(['status' => 'error', 'message' => 'Database Error: Could not process request.']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit();
}
?>