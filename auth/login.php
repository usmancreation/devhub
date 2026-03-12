<?php 
// Header Include
include '../includes/header.php';
?>

<style>
    .animate-slide-in-left {
        animation: slideInLeft 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        opacity: 0; /* Initially hidden before animation starts */
    }
    
    .animate-slide-in-right {
        animation: slideInRight 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        opacity: 0; /* Initially hidden before animation starts */
    }

    @keyframes slideInLeft {
        0% { transform: translateX(-60px); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
    }

    @keyframes slideInRight {
        0% { transform: translateX(60px); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
    }
</style>

<main class="min-h-[90vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden bg-[#0a0f1c]">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-accent-blue/10 rounded-full blur-[120px] -z-10 animate-pulse"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-accent-purple/10 rounded-full blur-[120px] -z-10 animate-pulse" style="animation-delay: 2s;"></div>

    <div class="max-w-6xl w-full bg-dark-card/80 backdrop-blur-xl border border-gray-800/60 rounded-[2rem] shadow-2xl overflow-hidden flex flex-col lg:flex-row relative z-10">
        
        <div class="w-full lg:w-[50%] p-8 sm:p-12 lg:p-14 animate-slide-in-left">
            
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-white mb-2 tracking-tight">Welcome Back</h2>
                <p class="text-gray-400 text-sm">Sign in to access your DevHub dashboard and premium resources.</p>
            </div>

            <form action="../actions/process_login.php" method="POST" class="space-y-6">
                
                <div class="group">
                    <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Email Address</label>
                    <div class="relative flex items-center">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-accent-blue transition-colors">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <input type="email" name="email" required class="w-full bg-dark-bg/50 border border-gray-700/50 text-white rounded-xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue pl-11 px-4 py-3.5 text-sm transition-all outline-none hover:border-gray-600" placeholder="developer@example.com">
                    </div>
                </div>
                
                <div class="group">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider">Password</label>
                        <a href="#" class="text-xs text-accent-blue hover:text-blue-400 hover:underline font-medium transition-colors">Forgot Password?</a>
                    </div>
                    <div class="relative flex items-center">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-accent-blue transition-colors">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="password" name="password" required class="w-full bg-dark-bg/50 border border-gray-700/50 text-white rounded-xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue pl-11 px-4 py-3.5 text-sm transition-all outline-none hover:border-gray-600" placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-accent-blue to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-bold py-4 px-4 rounded-xl transition-all shadow-[0_0_20px_rgba(59,130,246,0.3)] hover:shadow-[0_0_25px_rgba(59,130,246,0.5)] transform hover:-translate-y-0.5 mt-2 flex justify-center items-center group/btn">
                    Sign In <i class="fa-solid fa-arrow-right ml-2 group-hover/btn:translate-x-1 transition-transform"></i>
                </button>
            </form>

            <div class="relative flex items-center py-4 my-6">
                <div class="flex-grow border-t border-gray-800"></div>
                <span class="flex-shrink-0 mx-4 text-gray-600 text-[10px] font-bold uppercase tracking-wider">Or continue with</span>
                <div class="flex-grow border-t border-gray-800"></div>
            </div>

            <button class="w-full flex items-center justify-center gap-3 bg-dark-bg/50 border border-gray-700/50 hover:border-gray-500 hover:bg-gray-800/80 text-white font-medium py-3.5 px-4 rounded-xl transition-all group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Sign in with Google
            </button>

            <p class="mt-8 text-center text-gray-400 text-sm">
                Don't have an account? 
                <a href="register.php" class="text-white font-bold hover:text-accent-blue transition-colors ml-1 border-b border-transparent hover:border-accent-blue pb-0.5">Sign up for free</a>
            </p>
        </div>

        <div class="w-full lg:w-[50%] bg-gradient-to-br from-[#0f172a] to-[#020617] border-t lg:border-t-0 lg:border-l border-gray-800 p-8 sm:p-12 lg:p-14 relative hidden md:flex flex-col justify-between overflow-hidden animate-slide-in-right">
            
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 bg-blue-500/10 border border-blue-500/20 px-4 py-2 rounded-full mb-8">
                    <i class="fa-solid fa-bolt text-accent-blue text-xs"></i>
                    <span class="text-accent-blue text-xs font-bold tracking-wide uppercase">Your Workspace Awaits</span>
                </div>
                
                <h3 class="text-3xl font-bold text-white mb-8 leading-tight">Pick up exactly where <br><span class="text-gray-400">you left off.</span></h3>

                <ul class="space-y-6">
                    <li class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-500/10 flex items-center justify-center border border-blue-500/20 mt-1">
                            <i class="fa-solid fa-chart-line text-accent-blue text-sm"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-white font-bold text-base">Developer Dashboard</h4>
                            <p class="text-gray-400 text-sm mt-1 leading-relaxed">Access your purchased projects, active tool sessions, and manage your credits seamlessly.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-500/10 flex items-center justify-center border border-purple-500/20 mt-1">
                            <i class="fa-solid fa-code-branch text-accent-purple text-sm"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-white font-bold text-base">Sync Your Progress</h4>
                            <p class="text-gray-400 text-sm mt-1 leading-relaxed">Review your downloaded source codes and keep track of updates instantly.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-500/10 flex items-center justify-center border border-green-500/20 mt-1">
                            <i class="fa-solid fa-shield-halved text-green-400 text-sm"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-white font-bold text-base">Secure Connection</h4>
                            <p class="text-gray-400 text-sm mt-1 leading-relaxed">Your data, projects, and credits are protected with industry-standard encryption.</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="relative z-10 mt-12 pt-8 border-t border-gray-800/60">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-500 font-medium">© <?php echo date("Y"); ?> DevHub. All rights reserved.</p>
                    <a href="#" class="text-xs text-accent-blue hover:underline font-medium">Need Help?</a>
                </div>
            </div>

        </div>

    </div>
</main>

<?php 
// Footer Include
include '../includes/footer.php';
?>