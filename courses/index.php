<?php
session_start();
$base_url = "/CODEHUB/"; 
include '../includes/header.php'; 

// Dummy Array for Courses (Baad mein isay Database se connect karenge)
$courses = [
    [
        'id' => 1,
        'title' => 'Flutter & Firebase Masterclass',
        'desc' => 'Learn to build production-ready mobile apps with Flutter and Firebase backend.',
        'instructor' => 'Usman Writes',
        'duration' => '4.5 Hours',
        'level' => 'Intermediate',
        'color' => 'blue',
        'icon' => 'fa-mobile-screen-button',
        'students' => 1250,
    ],
    [
        'id' => 2,
        'title' => 'PHP & MySQL Web Development',
        'desc' => 'Build dynamic, database-driven websites from scratch using PHP and PDO.',
        'instructor' => 'DevHub Academy',
        'duration' => '6.0 Hours',
        'level' => 'Beginner',
        'color' => 'purple',
        'icon' => 'fa-server',
        'students' => 3420,
    ],
    [
        'id' => 3,
        'title' => 'Python for AI & Data Science',
        'desc' => 'Step-by-step guide to Python programming, Pandas, and building basic AI models.',
        'instructor' => 'Sarah Ahmed',
        'duration' => '8.2 Hours',
        'level' => 'Advanced',
        'color' => 'green',
        'icon' => 'fa-brain',
        'students' => 890,
    ],
    [
        'id' => 4,
        'title' => 'UI/UX Design with Figma',
        'desc' => 'Learn how to design beautiful, user-centric interfaces and prototypes.',
        'instructor' => 'Ali Raza',
        'duration' => '3.5 Hours',
        'level' => 'Beginner',
        'color' => 'pink',
        'icon' => 'fa-pen-nib',
        'students' => 2100,
    ]
];
?>

<main class="min-h-screen bg-[#0a0f1c] relative overflow-hidden pb-20">
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-green-900/10 rounded-full blur-[150px] -z-10 pointer-events-none"></div>
    <div class="absolute top-1/3 left-0 w-[500px] h-[500px] bg-blue-900/10 rounded-full blur-[120px] -z-10 pointer-events-none"></div>

    <div class="pt-16 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center relative z-10">
        <div class="inline-flex items-center gap-2 bg-gradient-to-r from-green-900/40 to-blue-900/40 border border-green-500/30 px-4 py-2 rounded-full mb-6 shadow-inner">
            <i class="fa-solid fa-certificate text-green-400"></i>
            <span class="text-white text-xs font-bold tracking-wide">Verified Certifications</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 tracking-tight">
            Learn skills. Pass the quiz. <br class="hidden md:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-accent-blue">Earn your Certificate.</span>
        </h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-10">
            Upgrade your resume with DevHub's professional video courses. Complete the modules, pass the final assessment, and instantly generate your verified legal certificate.
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="flex justify-between items-end mb-8 border-b border-gray-800 pb-4">
            <h2 class="text-2xl font-bold text-white">Available Courses</h2>
            <div class="text-sm font-medium text-gray-400">
                <i class="fa-solid fa-filter mr-1"></i> Filter
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            
            <?php foreach($courses as $course): ?>
                <div class="bg-dark-card border border-gray-800 rounded-3xl overflow-hidden hover:-translate-y-1.5 transition-all duration-300 group shadow-lg hover:shadow-2xl flex flex-col h-full">
                    
                    <div class="h-40 bg-gray-900 relative overflow-hidden flex items-center justify-center border-b border-gray-800">
                        <div class="absolute inset-0 opacity-20 bg-gradient-to-br from-<?php echo $course['color']; ?>-500 to-transparent"></div>
                        <i class="fa-solid <?php echo $course['icon']; ?> text-6xl text-<?php echo $course['color']; ?>-400 opacity-80 transform group-hover:scale-110 transition-transform duration-500"></i>
                        
                        <div class="absolute top-3 right-3 bg-dark-card/90 backdrop-blur-sm border border-gray-700 px-2.5 py-1 rounded-lg text-[10px] font-bold text-gray-300 uppercase tracking-wide shadow-sm">
                            <?php echo $course['level']; ?>
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs font-bold text-<?php echo $course['color']; ?>-400 bg-<?php echo $course['color']; ?>-500/10 px-2 py-0.5 rounded border border-<?php echo $course['color']; ?>-500/20">
                                <i class="fa-solid fa-video mr-1"></i> Video Course
                            </span>
                        </div>
                        
                        <h3 class="text-lg font-bold text-white mb-2 leading-snug group-hover:text-<?php echo $course['color']; ?>-400 transition-colors">
                            <?php echo $course['title']; ?>
                        </h3>
                        
                        <p class="text-gray-400 text-xs leading-relaxed mb-4 flex-1">
                            <?php echo $course['desc']; ?>
                        </p>

                        <div class="flex items-center justify-between text-xs text-gray-500 font-medium mb-5 pt-4 border-t border-gray-800">
                            <div class="flex items-center gap-1.5">
                                <i class="fa-solid fa-clock text-gray-400"></i> <?php echo $course['duration']; ?>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <i class="fa-solid fa-users text-gray-400"></i> <?php echo number_format($course['students']); ?>
                            </div>
                        </div>

                        <a href="watch.php?id=<?php echo $course['id']; ?>" class="block w-full text-center bg-gray-800 hover:bg-<?php echo $course['color']; ?>-600 text-white font-bold py-3 rounded-xl transition-all shadow-sm group/btn">
                            Start Learning <i class="fa-solid fa-play ml-1 group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>