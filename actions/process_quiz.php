<?php
session_start();

// Security Check
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../courses/index.php");
    exit();
}

$course_id = $_POST['course_id'] ?? 1;

// Course Titles
$courses = [
    1 => 'Flutter & Firebase Masterclass',
    2 => 'PHP & MySQL Web Development',
    3 => 'Python for AI & Data Science',
    4 => 'UI/UX Design with Figma'
];
$course_title = $courses[$course_id] ?? 'Professional Certification Course';

// Original Questions Array (Same as quiz.php to display text)
$questions = [
    1 => [
        'question' => 'Which programming language is primarily used by Flutter for app development?',
        'options' => ['A' => 'Java', 'B' => 'Kotlin', 'C' => 'Dart', 'D' => 'Swift']
    ],
    2 => [
        'question' => 'What is the main purpose of Firebase in a mobile application?',
        'options' => ['A' => 'Designing UI/UX', 'B' => 'Backend services and database', 'C' => 'Writing local CSS styling', 'D' => 'Compiling code to machine language']
    ],
    3 => [
        'question' => 'Which of the following is a state management approach in Flutter?',
        'options' => ['A' => 'Provider', 'B' => 'PDO', 'C' => 'Bootstrap', 'D' => 'Laravel']
    ]
];

// Correct Answers Logic
$correct_answers = [
    1 => 'C',
    2 => 'B',
    3 => 'A'
];

$total_questions = count($correct_answers);
$score = 0;
$user_answers = [];

// Calculate Score & Store User Answers
foreach ($correct_answers as $q_id => $correct_option) {
    $user_ans = $_POST['q_' . $q_id] ?? null;
    $user_answers[$q_id] = $user_ans;
    
    if ($user_ans === $correct_option) {
        $score++;
    }
}

// Calculate Percentage
$percentage = round(($score / $total_questions) * 100);
$passing_marks = 80; // Minimum 80% required
$is_passed = $percentage >= $passing_marks;

$base_url = "/CODEHUB/"; 
include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#0a0f1c] relative py-12 px-4 sm:px-6 lg:px-8">
    
    <?php if($is_passed): ?>
        <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-green-500/10 rounded-full blur-[150px] -z-10 pointer-events-none"></div>
    <?php else: ?>
        <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-red-500/10 rounded-full blur-[150px] -z-10 pointer-events-none"></div>
    <?php endif; ?>

    <div class="max-w-3xl mx-auto relative z-10">
        
        <?php if($is_passed): ?>
            <div class="bg-dark-card border border-green-500/30 rounded-[2rem] p-8 md:p-10 text-center shadow-2xl shadow-green-500/10 relative overflow-hidden mb-10">
                <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-5 shadow-[0_0_30px_rgba(74,222,128,0.4)] text-white text-3xl">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-white mb-2">Congratulations! 🎉</h1>
                <p class="text-gray-400 mb-6">
                    You passed <strong class="text-white"><?php echo $course_title; ?></strong> with <span class="text-green-400 font-bold"><?php echo $percentage; ?>%</span>.
                </p>

                <div class="bg-gray-900/80 border border-gray-800 rounded-2xl p-6 text-left relative z-10">
                    <h3 class="text-white font-bold mb-1"><i class="fa-solid fa-file-signature text-accent-blue mr-2"></i> Claim Your Certificate</h3>
                    <p class="text-gray-500 text-xs mb-5">Enter your exact legal name below for your verified certificate.</p>
                    
                    <form action="../courses/certificate.php" method="POST">
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                        <input type="hidden" name="score" value="<?php echo $percentage; ?>">
                        
                        <div class="mb-4">
                            <input type="text" name="legal_name" value="<?php echo htmlspecialchars($_SESSION['full_name']); ?>" class="w-full bg-dark-bg border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 px-4 py-3 text-lg transition-all outline-none text-center font-bold tracking-wide" required>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-400 hover:to-emerald-500 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg flex justify-center items-center group">
                            Generate Certificate <i class="fa-solid fa-wand-magic-sparkles ml-2 group-hover:scale-110 transition-transform"></i>
                        </button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-dark-card border border-red-500/30 rounded-[2rem] p-8 md:p-10 text-center shadow-2xl shadow-red-500/10 mb-10">
                <div class="w-20 h-20 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center mx-auto mb-5 shadow-[0_0_30px_rgba(248,113,113,0.4)] text-white text-4xl">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-white mb-2">Quiz Failed</h1>
                <p class="text-gray-400 mb-6">
                    You scored <span class="text-red-400 font-bold"><?php echo $percentage; ?>%</span>. You need at least <strong>80%</strong> to pass.
                </p>
                <a href="../courses/quiz.php?id=<?php echo $course_id; ?>" class="inline-flex justify-center items-center bg-gray-800 hover:bg-gray-700 text-white font-bold px-8 py-3.5 rounded-xl transition-all border border-gray-700 shadow-md">
                    <i class="fa-solid fa-rotate-right mr-2"></i> Try Again
                </a>
            </div>
        <?php endif; ?>


        <div class="mt-8">
            <h2 class="text-xl font-bold text-white mb-6 border-b border-gray-800 pb-4 flex items-center">
                <i class="fa-solid fa-list-check text-gray-500 mr-3"></i> Detailed Result Review
            </h2>

            <div class="space-y-6">
                <?php foreach($questions as $q_id => $q_data): 
                    $user_ans = $user_answers[$q_id];
                    $correct_ans = $correct_answers[$q_id];
                    $is_correct = ($user_ans === $correct_ans);
                ?>
                    <div class="bg-dark-card border <?php echo $is_correct ? 'border-green-500/30' : 'border-red-500/30'; ?> rounded-3xl p-6 relative overflow-hidden">
                        
                        <div class="absolute top-0 left-0 w-full h-1 <?php echo $is_correct ? 'bg-green-500' : 'bg-red-500'; ?>"></div>

                        <div class="flex items-start gap-3 mb-5">
                            <span class="text-gray-500 font-bold mt-0.5">Q<?php echo $q_id; ?>.</span>
                            <h3 class="text-white font-bold text-lg leading-relaxed"><?php echo $q_data['question']; ?></h3>
                        </div>

                        <div class="space-y-3 pl-0 md:pl-8">
                            <?php foreach($q_data['options'] as $key => $text): 
                                
                                // Default styling (Unselected, Neutral)
                                $bg_color = "bg-gray-900/50";
                                $border_color = "border-gray-800";
                                $text_color = "text-gray-400";
                                $icon = '<i class="fa-regular fa-circle text-gray-600 w-5"></i>';

                                // Sahi Jawab (Hamesha Green dikhayega)
                                if ($key === $correct_ans) {
                                    $bg_color = "bg-green-500/10";
                                    $border_color = "border-green-500/50";
                                    $text_color = "text-green-400 font-bold";
                                    $icon = '<i class="fa-solid fa-circle-check text-green-500 w-5"></i>';
                                } 
                                // Ghalat Jawab (Agar user ne yeh select kiya hai toh Red dikhayega)
                                elseif ($key === $user_ans && !$is_correct) {
                                    $bg_color = "bg-red-500/10";
                                    $border_color = "border-red-500/50";
                                    $text_color = "text-red-400 font-bold";
                                    $icon = '<i class="fa-solid fa-circle-xmark text-red-500 w-5"></i>';
                                }
                            ?>
                                <div class="flex items-center p-3 rounded-xl border <?php echo $border_color; ?> <?php echo $bg_color; ?> transition-colors">
                                    <span class="mr-3 text-lg"><?php echo $icon; ?></span>
                                    <span class="<?php echo $text_color; ?>">
                                        <strong class="mr-1 opacity-75"><?php echo $key; ?>.</strong> <?php echo $text; ?>
                                    </span>
                                    
                                    <?php if ($key === $user_ans): ?>
                                        <span class="ml-auto text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded bg-gray-800 text-gray-400 border border-gray-700">Your Answer</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</main>

<?php include '../includes/footer.php'; ?>