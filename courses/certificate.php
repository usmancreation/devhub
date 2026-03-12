<?php
session_start();

// Security Check
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Redirect if accessed directly without submitting the form
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

require_once '../config/db_connect.php';

$user_id = $_SESSION['user_id'];
$cert_cost = 10;
$insufficient_credits = false;

// 1. Fetch current credits
try {
    $stmt = $pdo->prepare("SELECT credits, full_name FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    
    if (!$user) { die("User not found."); }
    
    $current_credits = $user['credits'];
    
    if (!isset($_SESSION['full_name']) && isset($user['full_name'])) {
        $_SESSION['full_name'] = $user['full_name'];
    }
    
    // 2. Check and Deduct Credits
    if ($current_credits < $cert_cost) {
        $insufficient_credits = true;
    } else {
        // Deduct 10 credits
        $new_credits = $current_credits - $cert_cost;
        $update_stmt = $pdo->prepare("UPDATE users SET credits = ? WHERE id = ?");
        $update_stmt->execute([$new_credits, $user_id]);
        
        // Update Session
        $_SESSION['credits'] = $new_credits;
    }
} catch (PDOException $e) { die("Database Error"); }


$course_id = $_POST['course_id'] ?? 1;
$score = $_POST['score'] ?? 100;
$legal_name = trim($_POST['legal_name'] ?? $_SESSION['full_name']);

if(empty($legal_name)) {
    $legal_name = $user['full_name'] ?? 'Verified Student'; 
}

// Course Titles
$courses = [
    1 => ['title' => 'Flutter & Firebase Masterclass'],
    2 => ['title' => 'PHP & MySQL Web Development'],
    3 => ['title' => 'Python for AI & Data Science'],
    4 => ['title' => 'UI/UX Design with Figma']
];

$course_title = $courses[$course_id]['title'] ?? 'Professional Certification Course';

// Generate Certificate Meta Data
$date_issued = date('F j, Y');
$cert_id = 'DH-' . strtoupper(substr(md5(uniqid()), 0, 8)) . '-' . date('Y');

$base_url = "/CODEHUB/"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo htmlspecialchars($legal_name); ?> - DevHub Certificate</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Inter:wght@400;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'accent-blue': '#3b82f6',
                        'accent-gold': '#d4af37',
                        'dark-bg': '#0f172a',
                        'dark-card': '#1e293b'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                        script: ['Dancing Script', 'cursive'],
                    },
                }
            }
        }
    </script>

    <style>
        /* Print Styles */
        @media print {
            @page { size: A4 landscape; margin: 0; }
            body { background: white !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            #no-print-toolbar { display: none !important; }
            #printable-certificate { box-shadow: none !important; transform: scale(1) !important; width: 100% !important; height: 100vh !important; margin: 0 !important; page-break-inside: avoid; }
        }
        
        .cert-border {
            background-image: repeating-linear-gradient(-45deg, #d4af371a, #d4af371a 1px, transparent 1px, transparent 6px);
        }
    </style>
</head>
<body class="bg-dark-bg min-h-screen flex flex-col font-sans text-gray-800 selection:bg-accent-blue selection:text-white relative">

    <?php if($insufficient_credits): ?>
        <div class="flex-1 flex items-center justify-center p-4">
            <div class="bg-dark-card border border-red-500/30 rounded-3xl p-8 max-w-md w-full text-center shadow-2xl relative overflow-hidden">
                <div class="w-20 h-20 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-red-500/20">
                    <i class="fa-solid fa-coins text-4xl text-red-500"></i>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Insufficient Credits</h2>
                <p class="text-gray-400 text-sm mb-6">
                    You need <strong class="text-yellow-500">10 Credits</strong> to generate a verified certificate. You currently have <strong class="text-white"><?php echo $current_credits; ?></strong>.
                </p>
                <div class="flex flex-col gap-3">
                    <a href="../user/dashboard.php" class="bg-accent-blue hover:bg-blue-600 text-white font-bold py-3 rounded-xl transition-all w-full text-center shadow-lg shadow-blue-500/20">
                        Top Up Credits
                    </a>
                    <a href="index.php" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 rounded-xl transition-all w-full text-center">
                        Back to Courses
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>

        <div id="no-print-toolbar" class="bg-gray-900 border-b border-gray-800 p-4 sticky top-0 z-50 shadow-lg">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <a href="../user/dashboard.php" class="text-gray-400 hover:text-white flex items-center transition-colors font-medium text-sm">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Back to Dashboard
                    </a>
                    <div class="h-6 w-px bg-gray-700 hidden sm:block"></div>
                    <span class="text-xs text-green-400 font-bold bg-green-500/10 px-3 py-1.5 rounded-lg border border-green-500/20">
                        <i class="fa-solid fa-check mr-1"></i> 10 Credits Deducted
                    </span>
                </div>
                <div class="flex gap-3">
                    <button onclick="window.print()" class="bg-accent-blue hover:bg-blue-600 text-white px-6 py-2.5 rounded-lg font-bold shadow-lg shadow-blue-500/20 transition-all flex items-center">
                        <i class="fa-solid fa-download mr-2"></i> Download PDF
                    </button>
                </div>
            </div>
        </div>

        <div class="flex-1 flex justify-center items-center p-4 sm:p-8 overflow-x-auto">
            
            <div id="printable-certificate" class="bg-white w-[1120px] min-w-[1120px] h-[790px] relative p-10 shadow-2xl overflow-hidden shrink-0 mx-auto">
                
                <div class="absolute inset-0 m-6 border-[12px] border-double border-gray-300 pointer-events-none z-10"></div>
                <div class="absolute inset-0 m-10 border-2 border-accent-gold/40 pointer-events-none z-10"></div>
                
                <div class="absolute top-8 left-8 w-20 h-20 cert-border border-t-2 border-l-2 border-accent-gold/50 z-20"></div>
                <div class="absolute top-8 right-8 w-20 h-20 cert-border border-t-2 border-r-2 border-accent-gold/50 z-20"></div>
                <div class="absolute bottom-8 left-8 w-20 h-20 cert-border border-b-2 border-l-2 border-accent-gold/50 z-20"></div>
                <div class="absolute bottom-8 right-8 w-20 h-20 cert-border border-b-2 border-r-2 border-accent-gold/50 z-20"></div>

                <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-0 opacity-10 mt-10">
                    <div class="relative flex items-center justify-center">
                        <div class="absolute inset-0 bg-accent-gold rounded-full scale-[0.60]"></div>
                        <i class="fa-solid fa-award text-[500px] text-accent-gold"></i>
                    </div>
                </div>
                
                <div class="relative z-20 h-full flex flex-col items-center text-center px-16 py-8">
                    
                    <div class="flex items-center gap-3 mb-10">
                        <div class="bg-gradient-to-br from-accent-blue to-blue-800 p-3 rounded-xl shadow-md">
                            <i class="fa-solid fa-code text-white text-2xl"></i>
                        </div>
                        <span class="text-3xl font-extrabold tracking-tight text-gray-900">Dev<span class="text-accent-blue">Hub</span></span>
                    </div>

                    <p class="text-gray-500 uppercase tracking-widest font-bold text-xs mb-2">Verified Professional Certification</p>
                    <h1 class="font-serif text-5xl font-bold tracking-widest text-gray-900 mb-2 uppercase">Certificate of Achievement</h1>
                    <div class="w-32 h-1 bg-accent-gold mb-10 mt-2 mx-auto rounded-full shadow-sm"></div>

                    <p class="text-gray-600 uppercase tracking-widest font-semibold text-sm mb-6">
                        This is to proudly certify that
                    </p>

                    <h2 class="font-serif text-6xl text-accent-blue italic mb-6 font-bold" style="line-height: 1.2;">
                        <?php echo htmlspecialchars($legal_name); ?>
                    </h2>

                    <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-6 leading-relaxed bg-white/60 px-4 py-2 rounded-lg backdrop-blur-sm">
                        has successfully completed the comprehensive curriculum and passed the final assessment with a score of <strong class="text-gray-900"><?php echo $score; ?>%</strong> for the professional program:
                    </p>

                    <h3 class="font-serif text-3xl text-gray-900 font-bold mb-10 border-t border-b border-gray-200 py-4 w-full bg-white/60 backdrop-blur-sm">
                        "<?php echo htmlspecialchars($course_title); ?>"
                    </h3>

                    <div class="w-full grid grid-cols-3 items-end mt-auto px-10 pb-4">
                        
                        <div class="text-left">
                            <p class="text-gray-800 font-bold border-b-2 border-gray-400 pb-1 mb-2 px-2 text-center w-40"><?php echo $date_issued; ?></p>
                            <p class="text-gray-500 text-xs font-bold uppercase tracking-wider text-center w-40">Date Issued</p>
                            <p class="text-gray-400 text-[10px] mt-6 font-mono opacity-80">ID: <?php echo $cert_id; ?></p>
                        </div>

                        <div class="text-center flex flex-col items-center">
                            <p class="font-script text-4xl text-gray-800 border-b-2 border-gray-400 pb-1 mb-2 px-4 w-56 -rotate-2">
                                Sarah Ahmed
                            </p>
                            <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Academy Director</p>
                        </div>

                        <div class="text-right flex flex-col items-end">
                            <p class="font-script text-4xl text-gray-800 border-b-2 border-gray-400 pb-1 mb-2 px-4 text-center w-56 -rotate-2">
                                Usman Alam
                            </p>
                            <p class="text-gray-500 text-xs font-bold uppercase tracking-wider text-center w-56">CEO, DevHub</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>