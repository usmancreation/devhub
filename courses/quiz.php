<?php
session_start();
$base_url = "/CODEHUB/"; 

// Security Check
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$course_id = $_GET['id'] ?? 1;

// Course Titles
$courses = [
    1 => 'Flutter & Firebase Masterclass',
    2 => 'PHP & MySQL Web Development',
    3 => 'Python for AI & Data Science',
    4 => 'UI/UX Design with Figma'
];
$course_title = $courses[$course_id] ?? 'Professional Certification Course';

// Dummy Quiz Data (Isay baad mein Database se connect kiya ja sakta hai)
// Hum 3 simple questions rakh rahe hain testing ke liye
$questions = [
    [
        'id' => 1,
        'question' => 'Which programming language is primarily used by Flutter for app development?',
        'options' => [
            'A' => 'Java',
            'B' => 'Kotlin',
            'C' => 'Dart',
            'D' => 'Swift'
        ]
    ],
    [
        'id' => 2,
        'question' => 'What is the main purpose of Firebase in a mobile application?',
        'options' => [
            'A' => 'Designing UI/UX',
            'B' => 'Backend services and database',
            'C' => 'Writing local CSS styling',
            'D' => 'Compiling code to machine language'
        ]
    ],
    [
        'id' => 3,
        'question' => 'Which of the following is a state management approach in Flutter?',
        'options' => [
            'A' => 'Provider',
            'B' => 'PDO',
            'C' => 'Bootstrap',
            'D' => 'Laravel'
        ]
    ]
];

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#0a0f1c] relative pb-24">
    
    <div class="absolute top-0 inset-x-0 h-64 bg-gradient-to-b from-blue-900/20 to-transparent pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 relative z-10">
        
        <div class="bg-dark-card border border-gray-800 rounded-[2rem] p-6 md:p-8 mb-8 shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <div class="inline-flex items-center gap-2 bg-blue-500/10 border border-blue-500/20 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-accent-blue mb-3">
                    <i class="fa-solid fa-file-signature"></i> Final Assessment
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white mb-2 leading-tight">
                    <?php echo $course_title; ?>
                </h1>
                <p class="text-gray-400 text-sm">Pass this quiz with at least 80% to unlock your certificate.</p>
            </div>
            
            <div class="flex items-center gap-6 bg-gray-900/80 px-6 py-4 rounded-2xl border border-gray-700/50 shrink-0">
                <div class="text-center">
                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Questions</p>
                    <p class="text-xl font-extrabold text-white"><?php echo count($questions); ?></p>
                </div>
                <div class="w-px h-10 bg-gray-700"></div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Passing</p>
                    <p class="text-xl font-extrabold text-green-400">80%</p>
                </div>
            </div>
        </div>

        <form action="../actions/process_quiz.php" method="POST" class="space-y-6">
            
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

            <?php foreach($questions as $index => $q): ?>
                <div class="bg-dark-card border border-gray-800 rounded-3xl p-6 md:p-8 shadow-lg">
                    
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-accent-blue text-white flex items-center justify-center font-bold text-lg shrink-0 shadow-lg shadow-blue-500/20">
                            <?php echo $index + 1; ?>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-white mt-1 leading-relaxed">
                            <?php echo $q['question']; ?>
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pl-0 md:pl-14">
                        <?php foreach($q['options'] as $key => $option_text): ?>
                            <label class="relative block cursor-pointer group">
                                <input type="radio" name="q_<?php echo $q['id']; ?>" value="<?php echo $key; ?>" class="peer sr-only" required>
                                
                                <div class="w-full bg-gray-900/50 border-2 border-gray-700/50 rounded-xl p-4 transition-all duration-300 
                                            peer-checked:bg-blue-500/10 peer-checked:border-accent-blue peer-checked:shadow-[0_0_15px_rgba(59,130,246,0.2)]
                                            group-hover:border-gray-500">
                                    <div class="flex items-center gap-3">
                                        <div class="w-6 h-6 rounded-full border-2 border-gray-500 flex items-center justify-center shrink-0 
                                                    peer-checked:border-accent-blue peer-checked:bg-accent-blue transition-colors">
                                            <i class="fa-solid fa-check text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity hidden"></i>
                                            <div class="w-2 h-2 rounded-full bg-white opacity-0 transition-opacity hidden"></div>
                                        </div>
                                        <span class="text-gray-300 font-medium peer-checked:text-white transition-colors">
                                            <strong class="text-gray-500 mr-1"><?php echo $key; ?>.</strong> <?php echo $option_text; ?>
                                        </span>
                                    </div>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>

                </div>
            <?php endforeach; ?>

            <div class="bg-gray-900/80 backdrop-blur-xl border border-gray-800 rounded-[2rem] p-6 mt-10 sticky bottom-6 z-50 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-2xl">
                <p class="text-gray-400 text-sm font-medium">
                    <i class="fa-solid fa-shield-halved text-green-500 mr-1.5"></i> Ensure all questions are answered before submitting.
                </p>
                <button type="submit" class="w-full sm:w-auto bg-green-600 hover:bg-green-500 text-white px-8 py-3.5 rounded-xl font-bold shadow-lg shadow-green-500/30 transition-all flex items-center justify-center group">
                    Submit & Generate Certificate <i class="fa-solid fa-file-certificate ml-2 group-hover:scale-110 transition-transform"></i>
                </button>
            </div>

        </form>

    </div>
</main>

<style>
    /* CSS to show the white dot when the hidden radio button is checked */
    input[type="radio"]:checked + div > div > div {
        border-color: #3b82f6; /* accent-blue */
        background-color: #3b82f6;
    }
    input[type="radio"]:checked + div > div > div::after {
        content: '';
        display: block;
        width: 8px;
        height: 8px;
        background: white;
        border-radius: 50%;
    }
</style>

<?php include '../includes/footer.php'; ?>