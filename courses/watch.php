<?php
session_start();
$base_url = "/CODEHUB/"; 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$course_id = $_GET['id'] ?? 1;

$course_details = [
    1 => ['title' => 'Flutter & Firebase Masterclass', 'instructor' => 'Usman Writes', 'color' => 'blue'],
    2 => ['title' => 'PHP & MySQL Web Development', 'instructor' => 'DevHub Academy', 'color' => 'purple'],
];
$current_course = $course_details[$course_id] ?? $course_details[1];

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#0a0f1c] relative pb-20">
    
    <div class="bg-dark-card border-b border-gray-800 pt-4 pb-4 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex items-center gap-2 text-sm text-gray-400 font-medium">
            <a href="index.php" class="hover:text-white transition-colors">Courses</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-<?php echo $current_course['color']; ?>-400 font-bold"><?php echo $current_course['title']; ?></span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="w-full bg-black rounded-2xl overflow-hidden border border-gray-800 shadow-2xl relative aspect-video">
                    
                    <video id="course-video" class="w-full h-full object-cover" controls controlsList="nodownload">
                        <source src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    
                    <div id="video-overlay" class="absolute inset-0 bg-black/80 flex flex-col items-center justify-center z-10 hidden">
                        <i class="fa-solid fa-circle-notch fa-spin text-4xl text-accent-blue mb-4"></i>
                        <p class="text-white font-bold">Loading Module...</p>
                    </div>
                </div>

                <div class="bg-dark-card p-4 rounded-2xl border border-gray-800 flex items-center gap-4">
                    <span id="current-module-title" class="text-white font-bold text-sm min-w-[150px] truncate">Module 1</span>
                    <div class="flex-1 bg-gray-800 rounded-full h-2.5 relative overflow-hidden">
                        <div id="video-progress-bar" class="bg-accent-blue h-full w-[0%] transition-all duration-300"></div>
                    </div>
                    <span id="video-percentage" class="text-accent-blue font-bold text-sm min-w-[40px] text-right">0%</span>
                </div>

                <div class="bg-dark-card border border-gray-800 rounded-3xl p-6 md:p-8 shadow-lg">
                    <h1 class="text-2xl md:text-3xl font-extrabold text-white mb-3">
                        <?php echo $current_course['title']; ?>
                    </h1>
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-800">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-xs font-bold text-white">
                                <?php echo substr($current_course['instructor'], 0, 1); ?>
                            </div>
                            <span class="text-sm font-medium text-gray-300"><?php echo $current_course['instructor']; ?></span>
                        </div>
                    </div>
                    <div class="text-gray-400 text-sm leading-relaxed">
                        <p>Watch the video completely without skipping to unlock the next module. Once all modules are completed, the final certification quiz will be unlocked automatically.</p>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-gradient-to-br from-green-900/10 to-dark-card border border-gray-800 rounded-3xl p-6 relative overflow-hidden">
                    <h3 class="text-white font-bold text-lg mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-certificate text-green-400"></i> Get Certified
                    </h3>
                    <p class="text-gray-400 text-xs leading-relaxed mb-5">
                        Complete all video modules and pass the final quiz to generate your verified certificate.
                    </p>
                    
                    <div class="flex justify-between text-xs font-bold mb-2">
                        <span class="text-gray-300">Overall Progress</span>
                        <span id="overall-progress-text" class="text-green-400">0%</span>
                    </div>
                    <div class="w-full bg-gray-800 rounded-full h-2 mb-5">
                        <div id="overall-progress-bar" class="bg-green-500 h-2 rounded-full transition-all duration-500" style="width: 0%"></div>
                    </div>

                    <a href="quiz.php?id=<?php echo $course_id; ?>" id="quiz-btn" class="w-full bg-gray-700 text-gray-400 font-bold py-3.5 rounded-xl transition-all flex justify-center items-center pointer-events-none opacity-60">
                        <i class="fa-solid fa-lock mr-2"></i> Take Certification Quiz
                    </a>
                </div>

                <div class="bg-dark-card border border-gray-800 rounded-3xl overflow-hidden shadow-lg flex flex-col">
                    <div class="p-5 border-b border-gray-800 bg-gray-900/50 flex justify-between items-center">
                        <h3 class="text-white font-bold">Course Content</h3>
                        <span id="completed-count" class="text-xs text-accent-blue font-bold bg-blue-500/10 px-2 py-1 rounded">0/3 Completed</span>
                    </div>
                    
                    <div id="playlist-container" class="overflow-y-auto custom-scrollbar flex-1 max-h-[400px]">
                        </div>
                </div>

            </div>

        </div>
    </div>
</main>

<script>
    // ==========================================
    // 1. COURSE DATA (Playlist)
    // Testing ke liye 10 seconds ki dummy videos lagayi hain.
    // ==========================================
    const modules = [
        { id: 1, title: '1. Introduction & Setup', duration: '0:10', url: 'https://www.w3schools.com/html/mov_bbb.mp4', completed: false, locked: false },
        { id: 2, title: '2. Core Architecture', duration: '0:10', url: 'https://www.w3schools.com/html/mov_bbb.mp4', completed: false, locked: true },
        { id: 3, title: '3. Final Deployment', duration: '0:10', url: 'https://www.w3schools.com/html/mov_bbb.mp4', completed: false, locked: true }
    ];

    let currentIndex = 0;
    let maxWatchedTime = 0; 

    // DOM Elements
    const video = document.getElementById('course-video');
    const playlistContainer = document.getElementById('playlist-container');
    const videoProgressBar = document.getElementById('video-progress-bar');
    const videoPercentage = document.getElementById('video-percentage');
    const moduleTitle = document.getElementById('current-module-title');
    const quizBtn = document.getElementById('quiz-btn');
    const overallBar = document.getElementById('overall-progress-bar');
    const overallText = document.getElementById('overall-progress-text');
    const completedCount = document.getElementById('completed-count');

    // ==========================================
    // 2. RENDER PLAYLIST UI
    // ==========================================
    function renderPlaylist() {
        playlistContainer.innerHTML = '';
        let completed = 0;

        modules.forEach((mod, index) => {
            if(mod.completed) completed++;

            let statusIcon = '';
            let bgClass = '';
            let textClass = 'text-gray-300';
            
            if (mod.completed) {
                // Completed State (Blue Tick)
                statusIcon = '<i class="fa-solid fa-circle-check text-accent-blue"></i>';
                bgClass = 'hover:bg-gray-800 cursor-pointer';
            } else if (index === currentIndex) {
                // Active/Playing State
                statusIcon = '<i class="fa-solid fa-circle-play text-white"></i>';
                bgClass = 'bg-blue-500/20 border-l-4 border-accent-blue cursor-pointer';
                textClass = 'text-white';
            } else if (mod.locked) {
                // Locked State
                statusIcon = '<i class="fa-solid fa-lock text-gray-600"></i>';
                bgClass = 'opacity-50 cursor-not-allowed';
                textClass = 'text-gray-500';
            } else {
                // Unlocked but not played
                statusIcon = '<i class="fa-regular fa-circle text-gray-500"></i>';
                bgClass = 'hover:bg-gray-800 cursor-pointer';
            }

            const btn = document.createElement('div');
            btn.className = `w-full text-left p-4 border-b border-gray-800 transition-colors flex gap-3 items-center ${bgClass}`;
            btn.innerHTML = `
                <div class="mt-0.5 text-lg">${statusIcon}</div>
                <div>
                    <h4 class="${textClass} font-bold text-sm">${mod.title}</h4>
                    <p class="text-gray-500 text-xs mt-0.5"><i class="fa-solid fa-clock mr-1"></i> ${mod.duration}</p>
                </div>
            `;

            // Click event (Only if not locked)
            if(!mod.locked) {
                btn.onclick = () => loadVideo(index);
            }

            playlistContainer.appendChild(btn);
        });

        // Update Overall Progress
        completedCount.innerText = `${completed}/${modules.length} Completed`;
        let overallPerc = Math.round((completed / modules.length) * 100);
        overallBar.style.width = overallPerc + '%';
        overallText.innerText = overallPerc + '%';

        // Unlock Quiz Feature
        if(completed === modules.length) {
            quizBtn.classList.remove('bg-gray-700', 'text-gray-400', 'pointer-events-none', 'opacity-60');
            quizBtn.classList.add('bg-green-600', 'hover:bg-green-500', 'text-white', 'shadow-lg', 'shadow-green-500/30', 'cursor-pointer');
            quizBtn.innerHTML = 'Take Certification Quiz <i class="fa-solid fa-arrow-right ml-2"></i>';
        }
    }

    // ==========================================
    // 3. LOAD VIDEO LOGIC
    // ==========================================
    function loadVideo(index) {
        currentIndex = index;
        const mod = modules[index];
        
        video.src = mod.url;
        moduleTitle.innerText = mod.title;
        
        // Reset Progress UI
        videoProgressBar.style.width = '0%';
        videoPercentage.innerText = '0%';
        
        // Anti-skip setup: Agar video pehle se complete hai, toh maxWatchedTime full kar do taake aage piche kar sake.
        // Agar nayi hai, toh maxWatchedTime zero rakho.
        maxWatchedTime = mod.completed ? 999999 : 0;

        renderPlaylist();
        video.play();
    }

    // ==========================================
    // 4. VIDEO EVENTS (Anti-skip & Progress)
    // ==========================================
    
    // Time Update (Runs continuously while playing)
    video.addEventListener('timeupdate', function() {
        if(!video.duration) return;

        // Save real-time watching
        if (!video.seeking) {
            if(video.currentTime > maxWatchedTime) {
                maxWatchedTime = video.currentTime;
            }
        }

        // Calculate and show percentage
        let percent = (video.currentTime / video.duration) * 100;
        if(percent > 100) percent = 100;
        
        videoProgressBar.style.width = percent + '%';
        videoPercentage.innerText = Math.floor(percent) + '%';
    });

    // Anti-Skip Logic (Force time back if skipped ahead)
    video.addEventListener('seeking', function() {
        if (video.currentTime > maxWatchedTime) {
            video.currentTime = maxWatchedTime;
        }
    });

    // Video Ended Logic (Auto-Next & Mark Complete)
    video.addEventListener('ended', function() {
        // Mark current as complete
        modules[currentIndex].completed = true;
        
        // Unlock next module
        if(currentIndex + 1 < modules.length) {
            modules[currentIndex + 1].locked = false;
            loadVideo(currentIndex + 1); // Auto-start next
        } else {
            // All videos finished
            renderPlaylist(); // Update UI to unlock quiz
        }
    });

    // Initialize first video on page load
    window.onload = () => {
        loadVideo(0);
        video.pause(); // Let user click play first time if browser blocks auto-play
    };

</script>

<?php include '../includes/footer.php'; ?>