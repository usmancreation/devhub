<?php
// Session start karna zaroori hai taake pata chale user login hai ya nahi
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$base_url = "/CODEHUB/"; 
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>DevHub | Premium Developer Resources & AI Tools</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'accent-blue': '#3b82f6',
                        'accent-purple': '#a855f7',
                        'dark-bg': '#0f172a',
                        'dark-card': '#1e293b'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-dark-bg text-gray-100 font-sans antialiased flex flex-col min-h-screen">

<header class="sticky top-0 z-50 bg-dark-bg/80 backdrop-blur-md border-b border-gray-800">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <div class="flex items-center space-x-2">
                <div class="bg-gradient-to-br from-accent-blue to-accent-purple p-2 rounded-lg shadow-lg">
                    <i class="fa-solid fa-code text-white text-xl"></i>
                </div>
                <a href="<?php echo $base_url; ?>index.php" class="text-2xl font-extrabold tracking-tight text-white">Dev<span class="text-accent-blue">Hub</span></a>
            </div>
            
            <div class="hidden md:flex items-center space-x-6 lg:space-x-8 text-sm font-medium text-gray-300">
                
                <div class="relative group">
                    <button class="hover:text-accent-blue transition-colors flex items-center gap-1 pb-1">
                        Projects <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-dark-card border border-gray-700 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left scale-95 group-hover:scale-100 z-50">
                        <div class="py-2">
                            <a href="#" class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800 hover:text-accent-blue transition-colors"><i class="fa-solid fa-laptop-code mr-2 w-4 text-center"></i> Semester Project</a>
                            <a href="#" class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800 hover:text-accent-blue transition-colors"><i class="fa-solid fa-graduation-cap mr-2 w-4 text-center"></i> Final Year Project</a>
                        </div>
                    </div>
                </div>
                
                <div class="relative group">
                    <button class="hover:text-accent-blue transition-colors flex items-center gap-1 pb-1">
                        Utility Tools <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-dark-card border border-gray-700 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left scale-95 group-hover:scale-100 z-50">
                        <div class="py-2">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-accent-blue transition-colors"><i class="fa-solid fa-file-pdf mr-2 w-4 text-center"></i> PDF to Image</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-accent-blue transition-colors"><i class="fa-solid fa-image mr-2 w-4 text-center"></i> Image to PDF</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-accent-blue transition-colors"><i class="fa-solid fa-file-word mr-2 w-4 text-center"></i> PDF to Word</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-accent-blue transition-colors"><i class="fa-solid fa-file-excel mr-2 w-4 text-center"></i> PDF to Excel</a>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <button class="hover:text-accent-purple text-accent-purple font-bold transition-colors flex items-center gap-1 pb-1">
                        AI Tools <i class="fa-solid fa-sparkles text-xs ml-1"></i>
                    </button>
                    <div class="absolute left-0 mt-2 w-64 bg-dark-card border border-purple-500/30 rounded-lg shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left scale-95 group-hover:scale-100 z-50 overflow-hidden">
                        <div class="p-3 bg-gray-900/50 border-b border-gray-700/50">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Popular AI Tools</span>
                        </div>
                        <div class="py-2">
                            <a href="<?php echo $base_url; ?>tools/ai_chat.php" class="flex items-center px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition-colors group/item">
                                <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center mr-3 group-hover/item:bg-blue-500/20 transition-colors"><i class="fa-solid fa-robot text-blue-400"></i></div>
                                <div><p class="font-bold">AI Chat Assistant</p><p class="text-[10px] text-gray-500">Ask anything, get code.</p></div>
                            </a>
                            <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition-colors group/item">
                                <div class="w-8 h-8 rounded-lg bg-purple-500/10 flex items-center justify-center mr-3 group-hover/item:bg-purple-500/20 transition-colors"><i class="fa-solid fa-wand-magic-sparkles text-purple-400"></i></div>
                                <div><p class="font-bold">Code Generator</p><p class="text-[10px] text-gray-500">Generate full components.</p></div>
                            </a>
                            <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition-colors group/item">
                                <div class="w-8 h-8 rounded-lg bg-green-500/10 flex items-center justify-center mr-3 group-hover/item:bg-green-500/20 transition-colors"><i class="fa-solid fa-bug-slash text-green-400"></i></div>
                                <div><p class="font-bold">Debug Helper</p><p class="text-[10px] text-gray-500">Fix your errors fast.</p></div>
                            </a>
                            <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition-colors group/item">
                                <div class="w-8 h-8 rounded-lg bg-orange-500/10 flex items-center justify-center mr-3 group-hover/item:bg-orange-500/20 transition-colors"><i class="fa-solid fa-file-pen text-orange-400"></i></div>
                                <div><p class="font-bold">Assignment Helper</p><p class="text-[10px] text-gray-500">Step-by-step solutions.</p></div>
                            </a>
                            <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition-colors group/item">
                                <div class="w-8 h-8 rounded-lg bg-red-500/10 flex items-center justify-center mr-3 group-hover/item:bg-red-500/20 transition-colors"><i class="fa-solid fa-database text-red-400"></i></div>
                                <div><p class="font-bold">SQL Query Helper</p><p class="text-[10px] text-gray-500">Write complex queries.</p></div>
                            </a>
                        </div>
                        <div class="p-2 border-t border-gray-700/50 bg-gray-900/50">
                            <a href="<?php echo $base_url; ?>tools/all_tools.php" class="block w-full text-center px-4 py-2 text-xs font-bold text-accent-purple hover:bg-purple-500/10 rounded-md transition-colors">
                                View All AI Tools (20+) <i class="fa-solid fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <a class="hover:text-green-400 transition-colors flex items-center gap-1" href="<?php echo $base_url; ?>courses/index.php">
                    Courses <i class="fa-solid fa-certificate text-green-400 text-xs"></i>
                </a>
            </div>
            
            <div class="hidden md:flex items-center space-x-4">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="flex items-center bg-gray-900/50 border border-gray-700 rounded-full px-3 py-1.5 shadow-inner">
                        <i class="fa-solid fa-coins text-yellow-500 mr-2"></i>
                        <span class="text-white font-bold text-sm"><?php echo htmlspecialchars($_SESSION['credits'] ?? 0); ?></span>
                    </div>

                    <div class="relative group">
                        <button class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-accent-blue to-blue-700 text-white rounded-full font-bold shadow-lg shadow-blue-500/30 border-2 border-transparent hover:border-blue-300 transition-all focus:outline-none overflow-hidden">
                            <?php if(!empty($_SESSION['profile_image'])): ?>
                                <img src="<?php echo $base_url; ?>assets/images/profiles/<?php echo htmlspecialchars($_SESSION['profile_image']); ?>" class="w-full h-full object-cover" alt="Profile">
                            <?php else: ?>
                                <?php echo strtoupper(substr($_SESSION['full_name'], 0, 1)); ?>
                            <?php endif; ?>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 bg-dark-card border border-gray-700 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100 z-50 overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-700/50 bg-gray-800/20">
                                <p class="text-sm text-white font-bold truncate"><?php echo htmlspecialchars($_SESSION['full_name']); ?></p>
                            </div>
                            <div class="py-1">
                                <a href="<?php echo $base_url; ?>user/dashboard.php" class="block px-4 py-2.5 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                                    <i class="fa-solid fa-gauge mr-2 w-4 text-center text-accent-blue"></i> Dashboard
                                </a>
                                <div class="border-t border-gray-700/50 my-1"></div>
                                <a href="<?php echo $base_url; ?>actions/logout.php" class="block px-4 py-2.5 text-sm text-red-400 hover:bg-gray-800 hover:text-red-300 transition-colors">
                                    <i class="fa-solid fa-right-from-bracket mr-2 w-4 text-center"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>

                <?php else: ?>
                    <a href="<?php echo $base_url; ?>auth/login.php" class="inline-block text-center text-sm font-medium text-gray-300 border border-gray-700 hover:border-gray-500 hover:bg-gray-800 hover:text-white px-5 py-2 rounded-full transition-all duration-300 shadow-sm">
                        Login
                    </a>
                    <a href="<?php echo $base_url; ?>auth/register.php" class="inline-block text-center bg-accent-blue hover:bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-semibold transition-all shadow-lg shadow-blue-500/20">
                        Register
                    </a>
                <?php endif; ?>
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn" class="text-gray-300 hover:text-white focus:outline-none p-2 rounded-lg hover:bg-gray-800 transition">
                    <i id="mobile-icon" class="fa-solid fa-bars text-2xl transition-all duration-300"></i>
                </button>
            </div>
            
        </div>
    </nav>

    <div id="mobile-menu" class="hidden md:hidden bg-dark-card border-t border-gray-800 absolute w-full shadow-2xl z-40 transition-all duration-300">
        <div class="px-4 pt-4 pb-6 space-y-2">
            
            <div>
                <button id="mobile-projects-btn" class="w-full flex justify-between items-center px-3 py-3 rounded-lg text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition">
                    <div class="flex items-center"><i class="fa-solid fa-laptop-code w-6 text-accent-blue"></i> Projects</div>
                    <i id="mobile-projects-icon" class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
                </button>
                <div id="mobile-projects-list" class="hidden pl-10 pr-3 py-2 space-y-3 border-l border-gray-700 ml-4 mt-1">
                    <a href="#" class="block text-sm text-gray-400 hover:text-white transition">Semester Project</a>
                    <a href="#" class="block text-sm text-gray-400 hover:text-white transition">Final Year Project</a>
                </div>
            </div>
            
            <div>
                <button id="mobile-ai-btn" class="w-full flex justify-between items-center px-3 py-3 rounded-lg text-base font-bold text-accent-purple hover:text-purple-400 hover:bg-gray-800 transition">
                    <div class="flex items-center"><i class="fa-solid fa-sparkles w-6"></i> AI Tools</div>
                    <i id="mobile-ai-icon" class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
                </button>
                <div id="mobile-ai-list" class="hidden pl-10 pr-3 py-2 space-y-3 border-l border-purple-500/30 ml-4 mt-1">
                    <a href="<?php echo $base_url; ?>tools/ai_chat.php" class="block text-sm text-gray-300 hover:text-white transition"><i class="fa-solid fa-robot w-5 text-center mr-1 text-blue-400"></i> AI Chat Assistant</a>
                    <a href="#" class="block text-sm text-gray-300 hover:text-white transition"><i class="fa-solid fa-wand-magic-sparkles w-5 text-center mr-1 text-purple-400"></i> Code Generator</a>
                    <a href="#" class="block text-sm text-gray-300 hover:text-white transition"><i class="fa-solid fa-bug-slash w-5 text-center mr-1 text-green-400"></i> Debug Helper</a>
                    <a href="#" class="block text-sm text-gray-300 hover:text-white transition"><i class="fa-solid fa-file-pen w-5 text-center mr-1 text-orange-400"></i> Assignment Helper</a>
                    <a href="<?php echo $base_url; ?>tools/all_tools.php" class="block mt-2 text-sm font-bold text-accent-purple hover:text-purple-400 transition">View All Tools (20+) &rarr;</a>
                </div>
            </div>

            <div>
                <button id="mobile-tools-btn" class="w-full flex justify-between items-center px-3 py-3 rounded-lg text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition">
                    <div class="flex items-center"><i class="fa-solid fa-screwdriver-wrench w-6 text-gray-400"></i> Utility Tools</div>
                    <i id="mobile-tools-icon" class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
                </button>
                <div id="mobile-tools-list" class="hidden pl-10 pr-3 py-2 space-y-3 border-l border-gray-700 ml-4 mt-1">
                    <a href="#" class="block text-sm text-gray-400 hover:text-white transition"><i class="fa-solid fa-file-pdf w-5 text-center mr-1"></i> PDF to Image</a>
                    <a href="#" class="block text-sm text-gray-400 hover:text-white transition"><i class="fa-solid fa-image w-5 text-center mr-1"></i> Image to PDF</a>
                    <a href="#" class="block text-sm text-gray-400 hover:text-white transition"><i class="fa-solid fa-file-word w-5 text-center mr-1"></i> PDF to Word</a>
                </div>
            </div>

            <a href="<?php echo $base_url; ?>courses/index.php" class="flex items-center px-3 py-3 rounded-lg text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition">
                <i class="fa-solid fa-certificate w-6 text-green-400"></i> Courses & Certifications
            </a>
            
            <div class="mt-4 pt-4 border-t border-gray-800 flex flex-col space-y-3 px-2">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="flex items-center justify-between px-2 mb-2">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 bg-accent-blue text-white rounded-full font-bold overflow-hidden">
                                <?php if(!empty($_SESSION['profile_image'])): ?>
                                    <img src="<?php echo $base_url; ?>assets/images/profiles/<?php echo htmlspecialchars($_SESSION['profile_image']); ?>" class="w-full h-full object-cover" alt="Profile">
                                <?php else: ?>
                                    <?php echo strtoupper(substr($_SESSION['full_name'], 0, 1)); ?>
                                <?php endif; ?>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-white"><?php echo htmlspecialchars($_SESSION['full_name']); ?></p>
                                <p class="text-xs text-yellow-500 font-bold"><i class="fa-solid fa-coins mr-1"></i> <?php echo htmlspecialchars($_SESSION['credits'] ?? 0); ?> Credits</p>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo $base_url; ?>user/dashboard.php" class="block text-center px-4 py-3 text-white bg-gray-800 font-medium rounded-xl hover:bg-gray-700 transition"><i class="fa-solid fa-gauge mr-2"></i> Dashboard</a>
                    <a href="<?php echo $base_url; ?>actions/logout.php" class="block text-center px-4 py-3 text-red-500 bg-red-500/10 font-medium border border-red-500/20 rounded-xl hover:bg-red-500/20 transition"><i class="fa-solid fa-right-from-bracket mr-2"></i> Logout</a>
                <?php else: ?>
                    <a href="<?php echo $base_url; ?>auth/login.php" class="block text-center px-4 py-3 text-gray-300 hover:text-white font-medium border border-gray-700 rounded-xl hover:bg-gray-800 transition shadow-sm">Login</a>
                    <a href="<?php echo $base_url; ?>auth/register.php" class="block text-center bg-accent-blue hover:bg-blue-600 text-white px-4 py-3 rounded-xl font-bold transition shadow-lg shadow-blue-500/20">Sign Up (Get 100 Credits)</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('mobile-icon');

        if(btn && menu && icon) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
                if (menu.classList.contains('hidden')) {
                    icon.classList.remove('fa-xmark');
                    icon.classList.add('fa-bars');
                } else {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-xmark');
                }
            });
        }

        function setupMobileAccordion(btnId, listId, iconId) {
            const accordionBtn = document.getElementById(btnId);
            const accordionList = document.getElementById(listId);
            const accordionIcon = document.getElementById(iconId);
            
            if(accordionBtn && accordionList && accordionIcon) {
                accordionBtn.addEventListener('click', () => {
                    accordionList.classList.toggle('hidden');
                    accordionIcon.classList.toggle('rotate-180');
                });
            }
        }

        setupMobileAccordion('mobile-projects-btn', 'mobile-projects-list', 'mobile-projects-icon');
        setupMobileAccordion('mobile-tools-btn', 'mobile-tools-list', 'mobile-tools-icon');
        // Initialize new AI Tools Accordion
        setupMobileAccordion('mobile-ai-btn', 'mobile-ai-list', 'mobile-ai-icon');
    });
</script>