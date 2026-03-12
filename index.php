<?php include 'includes/header.php'; ?>

<style>
    /* Custom cursor blinking for dynamic typing */
    #typewriter {
        border-right: 4px solid #3b82f6;
        animation: blink-caret 0.75s step-end infinite;
        padding-right: 4px;
    }
    @keyframes blink-caret {
        from, to { border-color: transparent; }
        50% { border-color: #3b82f6; }
    }
    
    /* Gradient text for typewriter */
    .gradient-text {
        background: linear-gradient(to right, #3b82f6, #a855f7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<main>
    <section class="relative py-20 lg:py-32 overflow-hidden" data-purpose="hero-container">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 opacity-20">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-blue rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-purple rounded-full blur-[120px]"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            
            <div class="inline-flex items-center gap-2 bg-gray-800/50 border border-gray-700 px-4 py-1.5 rounded-full mb-8 shadow-sm">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent-blue opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                </span>
                <span class="text-gray-300 text-xs font-bold uppercase tracking-wider">New: AI Chat & Certifications Added</span>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight mb-4 flex flex-col items-center justify-center">
                <span>Level Up Your Code With</span> 
            </h1>
            
            <div class="h-12 md:h-16 mb-8 flex items-center justify-center">
                <span id="typewriter" class="gradient-text uppercase text-3xl md:text-5xl font-extrabold tracking-wide"></span>
            </div>
            
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-gray-400 mb-10">
                Download source codes, chat with AI, get certified in top frameworks, and use expert utility tools. Your ultimate developer ecosystem.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a class="w-full sm:w-auto px-8 py-4 bg-accent-blue hover:bg-blue-600 text-white rounded-xl font-bold transition-all transform hover:scale-105 shadow-xl shadow-blue-500/30 flex items-center justify-center" href="#projects">
                    Explore Projects <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
                <a class="w-full sm:w-auto px-8 py-4 bg-dark-card border border-gray-700 hover:border-gray-500 text-white rounded-xl font-bold transition-all flex items-center justify-center" href="#ai-tools">
                    <i class="fa-solid fa-sparkles text-accent-purple mr-2"></i> Try AI Tools
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-dark-card/30" data-purpose="process-steps">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-white mb-4">How DevHub Works</h2>
                <div class="w-20 h-1 bg-accent-blue mx-auto rounded-full mb-6"></div>
                <p class="text-gray-400 text-sm md:text-base leading-relaxed">
                    By combining a rewarding credit system with premium assets, DevHub ensures high-quality tech resources are accessible to everyone. Get <strong class="text-yellow-500">100 Free Credits</strong> on signup!
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                
                <div class="hidden md:block absolute top-8 left-[16%] right-[16%] h-0.5 bg-gray-800 -z-10"></div>

                <div class="text-center group relative bg-dark-bg p-6 rounded-3xl border border-gray-800 hover:border-blue-500/50 transition-all">
                    <div class="w-16 h-16 bg-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-accent-blue transition-colors duration-300 shadow-lg shadow-blue-500/20">
                        <i class="fa-solid fa-user-plus text-2xl text-accent-blue group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">1. Sign Up for Free</h3>
                    <p class="text-gray-400 text-sm">Create your account instantly and receive 100 complimentary credits in your wallet.</p>
                </div>
                <div class="text-center group relative bg-dark-bg p-6 rounded-3xl border border-gray-800 hover:border-purple-500/50 transition-all">
                    <div class="w-16 h-16 bg-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-accent-purple transition-colors duration-300 shadow-lg shadow-purple-500/20">
                        <i class="fa-solid fa-wand-magic-sparkles text-2xl text-accent-purple group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">2. Spend Credits</h3>
                    <p class="text-gray-400 text-sm">Use your credits to prompt AI assistants, download premium codes, or take quizzes.</p>
                </div>
                <div class="text-center group relative bg-dark-bg p-6 rounded-3xl border border-gray-800 hover:border-green-500/50 transition-all">
                    <div class="w-16 h-16 bg-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-green-500 transition-colors duration-300 shadow-lg shadow-green-500/20">
                        <i class="fa-solid fa-users text-2xl text-green-500 group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">3. Invite & Earn More</h3>
                    <p class="text-gray-400 text-sm">Out of credits? Share your unique referral link to earn 50 extra credits per friend.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24" id="ai-tools">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12 items-center">
                
                <div class="w-full lg:w-1/3">
                    <span class="text-accent-purple font-bold tracking-widest uppercase text-xs mb-2 block flex items-center"><i class="fa-solid fa-bolt text-yellow-500 mr-2"></i>Powered by AI</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4 leading-tight">Your Personal <br> Tech Assistant</h2>
                    <p class="text-gray-400 text-base leading-relaxed mb-8">
                        Stop wasting hours searching for solutions. DevHub's AI suite helps you write code, summarize notes, generate FYP ideas, and draft professional emails instantly. 
                        <br><br>
                        Just <strong class="text-yellow-500">5 Credits</strong> per prompt.
                    </p>
                    <a href="tools/all_tools.php" class="bg-gradient-to-r from-accent-purple to-blue-600 hover:to-blue-500 text-white font-bold px-8 py-3.5 rounded-xl transition-all shadow-lg shadow-purple-500/30 flex items-center w-max group">
                        View All 20+ Tools <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="w-full lg:w-2/3 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="tools/ai_chat.php" class="bg-dark-card border border-gray-800 hover:border-blue-500/50 p-6 rounded-3xl transition-all group flex flex-col justify-between shadow-lg">
                        <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center mb-4">
                            <i class="fa-solid fa-robot text-2xl text-blue-400 group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-white font-bold text-lg mb-2">AI Chat Assistant</h3>
                        <p class="text-gray-500 text-sm mb-4">Paste code, ask logic questions, or build components from scratch.</p>
                        <span class="text-xs font-bold text-blue-400 flex items-center">Launch Tool <i class="fa-solid fa-arrow-right ml-1"></i></span>
                    </a>
                    
                    <a href="tools/all_tools.php" class="bg-dark-card border border-gray-800 hover:border-green-500/50 p-6 rounded-3xl transition-all group flex flex-col justify-between shadow-lg sm:translate-y-6">
                        <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mb-4">
                            <i class="fa-solid fa-bug-slash text-2xl text-green-400 group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-white font-bold text-lg mb-2">Code Debugger</h3>
                        <p class="text-gray-500 text-sm mb-4">Find and fix errors in PHP, Flutter, or JS instantly with AI.</p>
                        <span class="text-xs font-bold text-green-400 flex items-center">Launch Tool <i class="fa-solid fa-arrow-right ml-1"></i></span>
                    </a>

                    <a href="tools/all_tools.php" class="bg-dark-card border border-gray-800 hover:border-orange-500/50 p-6 rounded-3xl transition-all group flex flex-col justify-between shadow-lg">
                        <div class="w-12 h-12 bg-orange-500/10 rounded-xl flex items-center justify-center mb-4">
                            <i class="fa-solid fa-rocket text-2xl text-orange-400 group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-white font-bold text-lg mb-2">FYP Idea Generator</h3>
                        <p class="text-gray-500 text-sm mb-4">Get unique Final Year Project ideas based on your tech stack.</p>
                        <span class="text-xs font-bold text-orange-400 flex items-center">Launch Tool <i class="fa-solid fa-arrow-right ml-1"></i></span>
                    </a>

                    <a href="tools/all_tools.php" class="bg-dark-card border border-gray-800 hover:border-pink-500/50 p-6 rounded-3xl transition-all group flex flex-col justify-between shadow-lg sm:translate-y-6">
                        <div class="w-12 h-12 bg-pink-500/10 rounded-xl flex items-center justify-center mb-4">
                            <i class="fa-solid fa-file-pen text-2xl text-pink-400 group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-white font-bold text-lg mb-2">Assignment Helper</h3>
                        <p class="text-gray-500 text-sm mb-4">Generate structured outlines and solutions for university tasks.</p>
                        <span class="text-xs font-bold text-pink-400 flex items-center">Launch Tool <i class="fa-solid fa-arrow-right ml-1"></i></span>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="py-24 bg-dark-card/40 border-y border-gray-800 relative overflow-hidden" id="courses">
        <div class="absolute right-0 top-0 w-64 h-64 bg-green-500/5 rounded-full blur-[100px] pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Learn & Get <span class="text-green-400">Certified</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto mb-12">Watch premium video modules, pass the final assessment quiz, and generate a verified certificate with your legal name to boost your resume.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                
                <a href="courses/watch.php?id=1" class="bg-dark-bg border border-gray-800 rounded-3xl overflow-hidden hover:-translate-y-1.5 transition-all duration-300 group shadow-lg text-left block">
                    <div class="h-40 bg-gray-900 relative overflow-hidden flex items-center justify-center border-b border-gray-800">
                        <div class="absolute inset-0 opacity-20 bg-gradient-to-br from-blue-500 to-transparent"></div>
                        <i class="fa-solid fa-mobile-screen-button text-6xl text-blue-400 opacity-80 transform group-hover:scale-110 transition-transform duration-500"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-blue-400 transition-colors">Flutter & Firebase</h3>
                        <p class="text-gray-400 text-xs mb-4 line-clamp-2">Learn to build production-ready mobile apps with Flutter.</p>
                        <div class="flex justify-between items-center text-xs text-gray-500 font-bold uppercase">
                            <span><i class="fa-solid fa-video mr-1"></i> 4 Modules</span>
                            <span class="text-green-400"><i class="fa-solid fa-award mr-1"></i> Certificate</span>
                        </div>
                    </div>
                </a>

                <a href="courses/watch.php?id=2" class="bg-dark-bg border border-gray-800 rounded-3xl overflow-hidden hover:-translate-y-1.5 transition-all duration-300 group shadow-lg text-left block">
                    <div class="h-40 bg-gray-900 relative overflow-hidden flex items-center justify-center border-b border-gray-800">
                        <div class="absolute inset-0 opacity-20 bg-gradient-to-br from-purple-500 to-transparent"></div>
                        <i class="fa-solid fa-server text-6xl text-purple-400 opacity-80 transform group-hover:scale-110 transition-transform duration-500"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-white mb-2 group-hover:text-purple-400 transition-colors">PHP & MySQL Web</h3>
                        <p class="text-gray-400 text-xs mb-4 line-clamp-2">Build dynamic websites from scratch using raw PHP.</p>
                        <div class="flex justify-between items-center text-xs text-gray-500 font-bold uppercase">
                            <span><i class="fa-solid fa-video mr-1"></i> 6 Modules</span>
                            <span class="text-green-400"><i class="fa-solid fa-award mr-1"></i> Certificate</span>
                        </div>
                    </div>
                </a>

                <div class="bg-gradient-to-br from-green-900/30 to-dark-bg border border-green-500/30 rounded-3xl p-6 flex flex-col justify-center items-center text-center shadow-lg relative overflow-hidden">
                    <i class="fa-solid fa-certificate text-6xl text-green-500/20 absolute -right-4 -bottom-4 transform rotate-12"></i>
                    <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mb-4 z-10">
                        <i class="fa-solid fa-graduation-cap text-2xl text-green-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 z-10">View All Courses</h3>
                    <p class="text-gray-400 text-xs mb-6 z-10">Browse our complete library of technical courses and earn your verification.</p>
                    <a href="courses/index.php" class="bg-gray-800 hover:bg-gray-700 border border-gray-700 text-white font-bold px-6 py-2.5 rounded-xl transition-all z-10 text-sm">
                        Browse Catalog
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="py-24" data-purpose="projects-grid" id="projects">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div class="max-w-2xl">
                    <span class="text-accent-blue font-bold tracking-widest uppercase text-xs mb-2 block"><i class="fa-solid fa-laptop-code mr-2"></i>Source Codes</span>
                    <h2 class="text-3xl font-bold text-white mb-4">Featured FYP Projects</h2>
                    <p class="text-gray-400 text-sm md:text-base leading-relaxed">
                        Accelerate your development cycle with our industry-standard, production-ready source codes. Perfect foundation for your Final Year Projects or enterprise solutions.
                    </p>
                </div>
                <a class="text-accent-blue hover:text-white font-semibold whitespace-nowrap transition-colors bg-blue-500/10 px-5 py-2.5 rounded-xl border border-blue-500/20" href="#">View All Projects <i class="fa-solid fa-arrow-right ml-1 text-xs"></i></a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-dark-card border border-gray-800 rounded-3xl overflow-hidden hover:border-accent-blue/50 transition-all group flex flex-col h-full shadow-lg">
                    <div class="h-48 bg-gray-700 relative overflow-hidden shrink-0">
                        <img alt="Project 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"/>
                        <span class="absolute top-4 right-4 bg-dark-bg/90 backdrop-blur px-3 py-1.5 rounded-lg text-[10px] font-bold text-accent-blue border border-blue-500/30">
                            <i class="fa-solid fa-star mr-1"></i> Premium
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex gap-2 mb-4">
                            <span class="px-2.5 py-1 bg-blue-500/10 text-blue-400 text-[10px] font-bold uppercase tracking-wider rounded border border-blue-500/20">PHP</span>
                            <span class="px-2.5 py-1 bg-emerald-500/10 text-emerald-400 text-[10px] font-bold uppercase tracking-wider rounded border border-emerald-500/20">MySQL</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-accent-blue transition-colors">E-Commerce Backend API</h3>
                        <p class="text-sm text-gray-400 mb-6 flex-1">Complete RESTful API solution with JWT auth and payment integration. Highly normalized database structure.</p>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-800">
                            <span class="text-lg font-bold text-white flex items-center gap-1.5"><i class="fa-solid fa-coins text-yellow-500 text-sm"></i> 49</span>
                            <button class="bg-gray-800 hover:bg-accent-blue text-white px-5 py-2 rounded-xl text-sm font-bold transition-all shadow-sm">Details</button>
                        </div>
                    </div>
                </div>

                <div class="bg-dark-card border border-gray-800 rounded-3xl overflow-hidden hover:border-cyan-500/50 transition-all group flex flex-col h-full shadow-lg">
                    <div class="h-48 bg-gray-700 relative overflow-hidden shrink-0">
                        <img alt="Project 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://images.unsplash.com/photo-1617042375876-a13e36732a04?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"/>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex gap-2 mb-4">
                            <span class="px-2.5 py-1 bg-cyan-500/10 text-cyan-400 text-[10px] font-bold uppercase tracking-wider rounded border border-cyan-500/20">Flutter</span>
                            <span class="px-2.5 py-1 bg-orange-500/10 text-orange-400 text-[10px] font-bold uppercase tracking-wider rounded border border-orange-500/20">Firebase</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">Food Delivery UI Kit</h3>
                        <p class="text-sm text-gray-400 mb-6 flex-1">Stunning multi-vendor food delivery app template with 40+ responsive screens and real-time logic.</p>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-800">
                            <span class="text-lg font-bold text-green-400">Free</span>
                            <button class="bg-cyan-600 hover:bg-cyan-500 text-white px-5 py-2 rounded-xl text-sm font-bold transition-all shadow-sm">Download</button>
                        </div>
                    </div>
                </div>

                <div class="bg-dark-card border border-gray-800 rounded-3xl overflow-hidden hover:border-yellow-500/50 transition-all group flex flex-col h-full shadow-lg">
                    <div class="h-48 bg-gray-700 relative overflow-hidden shrink-0">
                        <img alt="Project 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"/>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex gap-2 mb-4">
                            <span class="px-2.5 py-1 bg-yellow-500/10 text-yellow-400 text-[10px] font-bold uppercase tracking-wider rounded border border-yellow-500/20">JavaScript</span>
                            <span class="px-2.5 py-1 bg-purple-500/10 text-purple-400 text-[10px] font-bold uppercase tracking-wider rounded border border-purple-500/20">Tailwind</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors">Dynamic Portfolio Builder</h3>
                        <p class="text-sm text-gray-400 mb-6 flex-1">Drag and drop portfolio builder for freelancers and job seekers. Stand out with professional CVs.</p>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-800">
                            <span class="text-lg font-bold text-white flex items-center gap-1.5"><i class="fa-solid fa-coins text-yellow-500 text-sm"></i> 25</span>
                            <button class="bg-gray-800 hover:bg-yellow-500 hover:text-gray-900 text-white px-5 py-2 rounded-xl text-sm font-bold transition-all shadow-sm">Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 relative overflow-hidden bg-[#0a0f1c] border-y border-gray-800" id="document-tools">
        
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full -z-10 pointer-events-none">
            <div class="absolute top-1/4 left-0 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-1/4 right-0 w-96 h-96 bg-purple-600/10 rounded-full blur-[120px]"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTU5LjkgMEw1OS45IDYwTDAgNjBMMCA1OS45TDU5LjkgNTkuOVoiIGZpbGw9Im5vbmUiIHN0cm9rZT0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjAzKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9zdmc+')] opacity-60"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 bg-gray-800/50 border border-gray-700 px-4 py-1.5 rounded-full mb-6 shadow-sm">
                    <i class="fa-solid fa-layer-group text-accent-blue text-sm"></i>
                    <span class="text-gray-300 text-xs font-bold uppercase tracking-wider">Everyday Utilities</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">
                    Enterprise-Grade <br class="hidden sm:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-accent-purple">Document Suite</span>
                </h2>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Convert, merge, and format your documents instantly. Powered by secure algorithms to ensure your data is processed flawlessly.
                </p>
                
                <div class="flex flex-wrap justify-center gap-3 sm:gap-4 mt-8">
                    <span class="flex items-center text-xs font-bold text-gray-400 bg-dark-card border border-gray-800 px-3 py-2 rounded-lg shadow-inner"><i class="fa-solid fa-bolt text-yellow-500 mr-2 text-sm"></i> Lightning Fast</span>
                    <span class="flex items-center text-xs font-bold text-gray-400 bg-dark-card border border-gray-800 px-3 py-2 rounded-lg shadow-inner"><i class="fa-solid fa-shield-halved text-green-500 mr-2 text-sm"></i> 100% Secure</span>
                    <span class="flex items-center text-xs font-bold text-gray-400 bg-dark-card border border-gray-800 px-3 py-2 rounded-lg shadow-inner"><i class="fa-solid fa-wand-magic-sparkles text-purple-400 mr-2 text-sm"></i> Retains Format</span>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <a href="pdf_tools/pdf_to_word.php" class="group relative bg-dark-card/60 backdrop-blur-xl border border-gray-800 hover:border-blue-500/50 rounded-3xl p-6 md:p-8 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_10px_40px_-10px_rgba(59,130,246,0.2)] overflow-hidden block">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500/20 to-blue-600/10 border border-blue-500/30 rounded-2xl flex items-center justify-center mb-6 relative z-10 shadow-inner">
                        <i class="fa-solid fa-file-word text-2xl text-blue-400 group-hover:scale-110 transition-transform duration-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 relative z-10">PDF to Word</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8 relative z-10">Convert PDF documents into editable Word (.docx) files while preserving original layout.</p>
                    <div class="flex items-center text-blue-400 font-bold text-sm relative z-10 mt-auto">
                        Launch Tool <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <a href="pdf_tools/pdf_to_excel.php" class="group relative bg-dark-card/60 backdrop-blur-xl border border-gray-800 hover:border-green-500/50 rounded-3xl p-6 md:p-8 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_10px_40px_-10px_rgba(34,197,94,0.2)] overflow-hidden block lg:mt-6">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 bg-gradient-to-br from-green-500/20 to-green-600/10 border border-green-500/30 rounded-2xl flex items-center justify-center mb-6 relative z-10 shadow-inner">
                        <i class="fa-solid fa-file-excel text-2xl text-green-400 group-hover:scale-110 transition-transform duration-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 relative z-10">PDF to Excel</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8 relative z-10">Extract tabular data directly into organized, formula-ready Excel spreadsheets.</p>
                    <div class="flex items-center text-green-400 font-bold text-sm relative z-10 mt-auto">
                        Launch Tool <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <a href="pdf_tools/image_to_pdf.php" class="group relative bg-dark-card/60 backdrop-blur-xl border border-gray-800 hover:border-purple-500/50 rounded-3xl p-6 md:p-8 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_10px_40px_-10px_rgba(168,85,247,0.2)] overflow-hidden block">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/10 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500/20 to-purple-600/10 border border-purple-500/30 rounded-2xl flex items-center justify-center mb-6 relative z-10 shadow-inner">
                        <i class="fa-solid fa-images text-2xl text-purple-400 group-hover:scale-110 transition-transform duration-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 relative z-10">Image to PDF</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8 relative z-10">Merge multiple JPG or PNG images into a single, high-quality PDF document.</p>
                    <div class="flex items-center text-purple-400 font-bold text-sm relative z-10 mt-auto">
                        Launch Tool <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <a href="pdf_tools/pdf_to_jpg.php" class="group relative bg-dark-card/60 backdrop-blur-xl border border-gray-800 hover:border-orange-500/50 rounded-3xl p-6 md:p-8 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_10px_40px_-10px_rgba(249,115,22,0.2)] overflow-hidden block lg:mt-6">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500/10 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                    <div class="w-14 h-14 bg-gradient-to-br from-orange-500/20 to-orange-600/10 border border-orange-500/30 rounded-2xl flex items-center justify-center mb-6 relative z-10 shadow-inner">
                        <i class="fa-regular fa-image text-2xl text-orange-400 group-hover:scale-110 transition-transform duration-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 relative z-10">PDF to JPG</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8 relative z-10">Extract pages from any PDF and convert them into high-resolution JPG files.</p>
                    <div class="flex items-center text-orange-400 font-bold text-sm relative z-10 mt-auto">
                        Launch Tool <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

            </div>

            <div class="mt-14 text-center">
                <a href="pdf_tools/index.php" class="inline-flex items-center text-sm font-bold text-white bg-dark-card border border-gray-700 hover:border-gray-500 hover:bg-gray-800 px-8 py-3.5 rounded-xl transition-all shadow-lg group">
                    <i class="fa-solid fa-grid-2 mr-2"></i> View All Document Tools
                </a>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const words = ["Premium Resources", "AI Assistants", "Tech Certifications", "Semester Projects", "Beginner Guidance"];
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        const typeTarget = document.getElementById("typewriter");

        function typeEffect() {
            const currentWord = words[wordIndex];
            
            if (isDeleting) {
                typeTarget.innerText = currentWord.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typeTarget.innerText = currentWord.substring(0, charIndex + 1);
                charIndex++;
            }

            let typeSpeed = isDeleting ? 40 : 100;

            if (!isDeleting && charIndex === currentWord.length) {
                typeSpeed = 2500;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                typeSpeed = 400; 
            }

            setTimeout(typeEffect, typeSpeed);
        }

        if(typeTarget) typeEffect();
    });
</script>

<div id="welcome-modal" class="fixed inset-0 z-[100] flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeWelcomeModal()"></div>
    
    <div class="relative w-full max-w-md bg-dark-card border border-gray-700 rounded-3xl shadow-[0_0_40px_rgba(59,130,246,0.15)] p-8 transform scale-95 transition-transform duration-300" id="welcome-modal-box">
        
        <button onclick="closeWelcomeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-white transition-colors w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-accent-blue to-accent-purple text-white shadow-lg mb-4">
                <i class="fa-solid fa-code text-2xl"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-white mb-1">Welcome to DevHub</h2>
            <p class="text-gray-400 text-sm">Sign in to access your dashboard.</p>
        </div>

        <div class="bg-gradient-to-r from-purple-900/30 to-blue-900/30 border border-purple-500/30 rounded-xl p-4 mb-6 flex items-start gap-4">
            <div class="text-accent-purple text-2xl animate-bounce mt-1">
                <i class="fa-solid fa-gift"></i>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm">Claim Your 100 Credits!</h4>
                <p class="text-gray-300 text-xs mt-1 leading-relaxed">Don't have an account? Sign up today and get <span class="text-accent-blue font-bold">100 Free Credits</span> instantly to use AI tools.</p>
            </div>
        </div>

        <form action="auth/login.php" method="POST" class="space-y-4">
            <a href="auth/login.php" class="w-full block text-center bg-accent-blue hover:bg-blue-600 text-white font-bold py-3.5 px-4 rounded-xl transition-all shadow-lg shadow-blue-500/30 mt-2 group">
                Sign In Now <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </form>

        <div class="mt-6 text-center border-t border-gray-800 pt-6">
            <p class="text-gray-400 text-sm">
                New to DevHub? 
                <a href="auth/register.php" class="text-white font-extrabold hover:text-accent-blue transition-colors ml-1">
                    Create an account
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const welcomeModal = document.getElementById('welcome-modal');
        const welcomeModalBox = document.getElementById('welcome-modal-box');

        <?php if(!isset($_SESSION['user_id'])): ?>
            window.openWelcomeModal = function() {
                welcomeModal.classList.remove('opacity-0', 'pointer-events-none');
                welcomeModalBox.classList.remove('scale-95');
                welcomeModalBox.classList.add('scale-100');
            };

            window.closeWelcomeModal = function() {
                welcomeModal.classList.add('opacity-0', 'pointer-events-none');
                welcomeModalBox.classList.remove('scale-100');
                welcomeModalBox.classList.add('scale-95');
                sessionStorage.setItem('devhub_modal_shown', 'true');
            };

            if (!sessionStorage.getItem('devhub_modal_shown')) {
                setTimeout(openWelcomeModal, 2000);
            }
        <?php endif; ?>
    });
</script>

<?php include 'includes/footer.php'; ?>