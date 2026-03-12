<?php
session_start();
include '../includes/header.php'; 

// Array of all 20+ AI Tools
$ai_tools = [
    // Coding & Development
    ['title' => 'AI Chat Assistant', 'desc' => 'Your personal AI coding buddy. Ask anything, get instant code solutions.', 'icon' => 'fa-robot', 'color' => 'text-blue-400', 'bg' => 'bg-blue-500/10', 'border' => 'group-hover:border-blue-500/50', 'link' => 'ai_chat.php', 'category' => 'Coding', 'cost' => 5],
    ['title' => 'Code Generator', 'desc' => 'Generate full components, functions, and boilerplate code in seconds.', 'icon' => 'fa-wand-magic-sparkles', 'color' => 'text-purple-400', 'bg' => 'bg-purple-500/10', 'border' => 'group-hover:border-purple-500/50', 'link' => '#', 'category' => 'Coding', 'cost' => 5],
    ['title' => 'Debug Helper', 'desc' => 'Paste your error logs and let AI explain and fix the bugs for you.', 'icon' => 'fa-bug-slash', 'color' => 'text-green-400', 'bg' => 'bg-green-500/10', 'border' => 'group-hover:border-green-500/50', 'link' => '#', 'category' => 'Coding', 'cost' => 5],
    ['title' => 'SQL Query Helper', 'desc' => 'Write complex database queries easily from plain English descriptions.', 'icon' => 'fa-database', 'color' => 'text-red-400', 'bg' => 'bg-red-500/10', 'border' => 'group-hover:border-red-500/50', 'link' => '#', 'category' => 'Coding', 'cost' => 5],
    ['title' => 'Project Idea Generator', 'desc' => 'Get unique, modern project ideas tailored to your skill level.', 'icon' => 'fa-rocket', 'color' => 'text-orange-400', 'bg' => 'bg-orange-500/10', 'border' => 'group-hover:border-orange-500/50', 'link' => '#', 'category' => 'Coding', 'cost' => 5],

    // Student & Academic
    ['title' => 'Assignment Helper', 'desc' => 'Get step-by-step guidance and structuring for your university assignments.', 'icon' => 'fa-file-pen', 'color' => 'text-emerald-400', 'bg' => 'bg-emerald-500/10', 'border' => 'group-hover:border-emerald-500/50', 'link' => '#', 'category' => 'Academic', 'cost' => 5],
    ['title' => 'Notes Summarizer', 'desc' => 'Paste long lecture notes and get short, digestible bullet points.', 'icon' => 'fa-list-check', 'color' => 'text-yellow-400', 'bg' => 'bg-yellow-500/10', 'border' => 'group-hover:border-yellow-500/50', 'link' => '#', 'category' => 'Academic', 'cost' => 5],
    ['title' => 'Research Topic Generator', 'desc' => 'Find untapped research gaps and thesis topics in your field.', 'icon' => 'fa-lightbulb', 'color' => 'text-amber-400', 'bg' => 'bg-amber-500/10', 'border' => 'group-hover:border-amber-500/50', 'link' => '#', 'category' => 'Academic', 'cost' => 5],
    ['title' => 'Quiz Generator', 'desc' => 'Generate custom quizzes from your syllabus to test your knowledge.', 'icon' => 'fa-circle-question', 'color' => 'text-violet-400', 'bg' => 'bg-violet-500/10', 'border' => 'group-hover:border-violet-500/50', 'link' => '#', 'category' => 'Academic', 'cost' => 5],
    ['title' => 'MCQs Generator', 'desc' => 'Instantly create multiple-choice questions for exam preparation.', 'icon' => 'fa-list-ol', 'color' => 'text-sky-400', 'bg' => 'bg-sky-500/10', 'border' => 'group-hover:border-sky-500/50', 'link' => '#', 'category' => 'Academic', 'cost' => 5],

    // Writing & Content
    ['title' => 'Essay Writer', 'desc' => 'Structure and draft comprehensive essays with academic tone.', 'icon' => 'fa-feather', 'color' => 'text-teal-400', 'bg' => 'bg-teal-500/10', 'border' => 'group-hover:border-teal-500/50', 'link' => '#', 'category' => 'Writing', 'cost' => 5],
    ['title' => 'Grammar Checker', 'desc' => 'Advanced proofreading, grammar fixes, and tone adjustments.', 'icon' => 'fa-check-double', 'color' => 'text-pink-400', 'bg' => 'bg-pink-500/10', 'border' => 'group-hover:border-pink-500/50', 'link' => '#', 'category' => 'Writing', 'cost' => 5],
    ['title' => 'Paraphrase Tool', 'desc' => 'Rewrite text to avoid plagiarism and improve readability.', 'icon' => 'fa-pen-nib', 'color' => 'text-fuchsia-400', 'bg' => 'bg-fuchsia-500/10', 'border' => 'group-hover:border-fuchsia-500/50', 'link' => '#', 'category' => 'Writing', 'cost' => 5],
    ['title' => 'Explanation Tool', 'desc' => 'Explain complex technical concepts in simple, everyday language.', 'icon' => 'fa-comment-dots', 'color' => 'text-lime-400', 'bg' => 'bg-lime-500/10', 'border' => 'group-hover:border-lime-500/50', 'link' => '#', 'category' => 'Writing', 'cost' => 5],
    ['title' => 'Translation Tool', 'desc' => 'Accurate, context-aware translations across multiple languages.', 'icon' => 'fa-language', 'color' => 'text-cyan-400', 'bg' => 'bg-cyan-500/10', 'border' => 'group-hover:border-cyan-500/50', 'link' => '#', 'category' => 'Writing', 'cost' => 5],

    // Career & Professional
    ['title' => 'Resume Builder', 'desc' => 'Generate professional, ATS-friendly resume bullet points.', 'icon' => 'fa-file-user', 'color' => 'text-indigo-400', 'bg' => 'bg-indigo-500/10', 'border' => 'group-hover:border-indigo-500/50', 'link' => '#', 'category' => 'Career', 'cost' => 5],
    ['title' => 'Cover Letter Writer', 'desc' => 'Craft compelling cover letters tailored to specific job descriptions.', 'icon' => 'fa-envelope-open', 'color' => 'text-rose-400', 'bg' => 'bg-rose-500/10', 'border' => 'group-hover:border-rose-500/50', 'link' => '#', 'category' => 'Career', 'cost' => 5],
    ['title' => 'Email Writer', 'desc' => 'Draft professional emails for clients, professors, or recruiters.', 'icon' => 'fa-envelope-open-text', 'color' => 'text-blue-500', 'bg' => 'bg-blue-600/10', 'border' => 'group-hover:border-blue-600/50', 'link' => '#', 'category' => 'Career', 'cost' => 5],
    ['title' => 'SOP Helper', 'desc' => 'Create powerful Statements of Purpose for university admissions.', 'icon' => 'fa-scroll', 'color' => 'text-purple-500', 'bg' => 'bg-purple-600/10', 'border' => 'group-hover:border-purple-600/50', 'link' => '#', 'category' => 'Career', 'cost' => 5],
    ['title' => 'Presentation Outline', 'desc' => 'Generate structured outlines for your PowerPoint presentations.', 'icon' => 'fa-person-chalkboard', 'color' => 'text-orange-500', 'bg' => 'bg-orange-600/10', 'border' => 'group-hover:border-orange-600/50', 'link' => '#', 'category' => 'Career', 'cost' => 5],
];
?>

<main class="min-h-screen bg-[#0a0f1c] relative overflow-hidden pb-20">
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-accent-purple/10 rounded-full blur-[150px] -z-10 pointer-events-none"></div>
    <div class="absolute top-1/3 left-0 w-[500px] h-[500px] bg-accent-blue/10 rounded-full blur-[120px] -z-10 pointer-events-none"></div>

    <div class="pt-16 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center relative z-10">
        <div class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-900/40 to-blue-900/40 border border-purple-500/30 px-4 py-2 rounded-full mb-6 shadow-inner">
            <i class="fa-solid fa-sparkles text-accent-purple"></i>
            <span class="text-white text-xs font-bold tracking-wide">Premium AI Toolset</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 tracking-tight">
            Supercharge your workflow <br class="hidden md:block">
            with <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-blue to-accent-purple">20+ AI Tools</span>
        </h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-10">
            From writing code and debugging to drafting essays and generating research topics, DevHub's AI suite has everything you need.
        </p>

        <div class="max-w-2xl mx-auto relative group">
            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-500 group-focus-within:text-accent-blue transition-colors">
                <i class="fa-solid fa-magnifying-glass text-lg"></i>
            </div>
            <input type="text" id="searchInput" onkeyup="filterTools()" class="w-full bg-dark-card/80 backdrop-blur-sm border border-gray-700 text-white rounded-2xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue pl-14 pr-6 py-4 text-lg transition-all outline-none shadow-xl" placeholder="Search for tools (e.g., Code Generator, Essay Writer)...">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <button class="px-5 py-2 rounded-full bg-accent-blue text-white text-sm font-bold shadow-lg shadow-blue-500/30 transition-all">All Tools</button>
            <button class="px-5 py-2 rounded-full bg-dark-card border border-gray-700 text-gray-400 hover:text-white hover:border-gray-500 text-sm font-bold transition-all">Coding</button>
            <button class="px-5 py-2 rounded-full bg-dark-card border border-gray-700 text-gray-400 hover:text-white hover:border-gray-500 text-sm font-bold transition-all">Academic</button>
            <button class="px-5 py-2 rounded-full bg-dark-card border border-gray-700 text-gray-400 hover:text-white hover:border-gray-500 text-sm font-bold transition-all">Career</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="toolsGrid">
            
            <?php foreach($ai_tools as $tool): ?>
                <a href="<?php echo htmlspecialchars($tool['link']); ?>" class="tool-card block bg-dark-card border border-gray-800 rounded-3xl p-6 hover:-translate-y-1.5 transition-all duration-300 group shadow-lg hover:shadow-2xl hover:shadow-purple-500/10 <?php echo $tool['border']; ?> relative overflow-hidden" data-title="<?php echo strtolower($tool['title'] . " " . $tool['category']); ?>">
                    
                    <div class="absolute top-5 right-5 bg-gray-900/90 backdrop-blur-md border border-gray-700 px-2.5 py-1 rounded-lg flex items-center gap-1.5 shadow-md">
                        <i class="fa-solid fa-bolt text-yellow-500 text-[10px]"></i>
                        <span class="text-xs font-bold text-white"><?php echo $tool['cost']; ?> Credits</span>
                    </div>

                    <div class="flex justify-between items-start mb-6 mt-2">
                        <div class="w-14 h-14 rounded-2xl <?php echo $tool['bg']; ?> flex items-center justify-center border border-white/5 group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid <?php echo $tool['icon']; ?> text-2xl <?php echo $tool['color']; ?>"></i>
                        </div>
                    </div>

                    <div class="mb-3 flex items-center gap-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-500 bg-gray-900 px-2 py-0.5 rounded border border-gray-800">
                            <?php echo $tool['category']; ?>
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-accent-purple transition-colors tool-title">
                        <?php echo $tool['title']; ?>
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        <?php echo $tool['desc']; ?>
                    </p>

                    <div class="flex items-center text-sm font-bold text-gray-500 group-hover:text-white transition-colors mt-auto pt-4 border-t border-gray-800">
                        Launch Tool <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>
            <?php endforeach; ?>

        </div>

        <div id="noResults" class="hidden text-center py-20">
            <div class="w-20 h-20 bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-6 border border-gray-800">
                <i class="fa-solid fa-face-frown-open text-4xl text-gray-500"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">No tools found</h3>
            <p class="text-gray-400">Try searching with different keywords.</p>
        </div>

    </div>
</main>

<script>
function filterTools() {
    let input = document.getElementById('searchInput').value.toLowerCase();
    let cards = document.getElementsByClassName('tool-card');
    let noResults = document.getElementById('noResults');
    let hasVisibleCards = false;

    for (let i = 0; i < cards.length; i++) {
        let titleData = cards[i].getAttribute('data-title');
        
        if (titleData.includes(input)) {
            cards[i].style.display = ""; // Show card
            hasVisibleCards = true;
        } else {
            cards[i].style.display = "none"; // Hide card
        }
    }

    if (hasVisibleCards) {
        noResults.classList.add('hidden');
    } else {
        noResults.classList.remove('hidden');
    }
}
</script>

<?php include '../includes/footer.php'; ?>