<?php
session_start();

// Security Check: Agar user login nahi hai, toh login page par bhej dein
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../config/db_connect.php';

try {
    // UPDATED QUERY: profile_completion bhi DB se fetch kar rahe hain
$stmt = $pdo->prepare("SELECT full_name, email, credits, referral_code, created_at, profile_completion, profile_image FROM users WHERE id = ?");    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        header("Location: ../actions/logout.php");
        exit();
    }

    // Session Update
    $_SESSION['credits'] = $user['credits'];
    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['profile_image'] = $user['profile_image'];
    $ref_stmt = $pdo->prepare("SELECT COUNT(id) as total_referrals FROM users WHERE referred_by = ?");
    $ref_stmt->execute([$user['referral_code']]);
    $referral_data = $ref_stmt->fetch();
    $total_referrals = $referral_data['total_referrals'] ?? 0;

    // Database se completion status get karein, default 45
    $profile_completion = $user['profile_completion'] ?? 45;

} catch (PDOException $e) {
    die("Error loading dashboard: " . $e->getMessage());
}

include '../includes/header.php'; 
?>

<main class="min-h-screen py-10 px-4 sm:px-6 lg:px-8 bg-[#0a0f1c] relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-blue-900/20 to-transparent -z-10"></div>
    <div class="absolute top-20 right-10 w-96 h-96 bg-accent-purple/5 rounded-full blur-[100px] -z-10"></div>

    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-white mb-1">Welcome back, <span class="text-accent-blue"><?php echo htmlspecialchars(explode(' ', trim($user['full_name']))[0]); ?></span>! 👋</h1>
                <p class="text-gray-400 text-sm">Here is what's happening with your DevHub account today.</p>
            </div>
            <div class="flex gap-3">
                <a href="../index.php#projects" class="bg-dark-card border border-gray-700 hover:border-gray-500 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-all flex items-center shadow-sm">
                    <i class="fa-solid fa-laptop-code mr-2"></i> Browse Projects
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-gradient-to-br from-blue-900/40 to-dark-card border border-blue-500/30 p-6 rounded-3xl relative overflow-hidden group hover:border-blue-500/60 transition-all">
                <div class="absolute -right-6 -top-6 text-blue-500/10 group-hover:text-blue-500/20 transition-colors">
                    <i class="fa-solid fa-coins text-9xl"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-blue-400 text-sm font-bold uppercase tracking-wider mb-2 flex items-center"><i class="fa-solid fa-wallet mr-2"></i> Wallet Balance</p>
                    <h2 class="text-4xl font-extrabold text-white mb-1"><?php echo number_format($user['credits']); ?></h2>
                    <p class="text-gray-400 text-sm">Available DevHub Credits</p>
                    <button class="mt-5 text-sm font-bold text-white bg-blue-600 hover:bg-blue-500 px-5 py-2 rounded-lg transition-colors shadow-lg shadow-blue-500/20">Top Up Credits</button>
                </div>
            </div>

            <div class="bg-dark-card border border-gray-800 p-6 rounded-3xl relative overflow-hidden hover:border-gray-700 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-wider"><i class="fa-solid fa-cloud-arrow-down mr-2"></i> My Downloads</p>
                    <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400"><i class="fa-solid fa-folder-open"></i></div>
                </div>
                <h2 class="text-3xl font-extrabold text-white mb-1">0</h2>
                <p class="text-gray-500 text-sm">Projects downloaded so far</p>
            </div>

            <div class="bg-dark-card border border-gray-800 p-6 rounded-3xl relative overflow-hidden hover:border-gray-700 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-wider"><i class="fa-solid fa-users mr-2"></i> Friends Invited</p>
                    <div class="w-10 h-10 rounded-full bg-green-500/10 flex items-center justify-center text-green-500"><i class="fa-solid fa-user-plus"></i></div>
                </div>
                <h2 class="text-3xl font-extrabold text-white mb-1"><?php echo htmlspecialchars($total_referrals); ?></h2>
                <p class="text-gray-500 text-sm">Total successful referrals</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <?php if (isset($_SESSION['success_msg'])): ?>
                    <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-xl flex items-center mb-6">
                        <i class="fa-solid fa-circle-check mr-3"></i>
                        <?php 
                            echo $_SESSION['success_msg'];
                            unset($_SESSION['success_msg']); 
                        ?>
                    </div>
                <?php endif; ?>

                <div class="bg-gradient-to-r from-purple-900/40 to-dark-card border border-purple-500/30 p-8 rounded-3xl flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-purple-500/20 text-accent-purple px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                            <i class="fa-solid fa-fire"></i> Earn Free Credits
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Invite friends, get 50 credits!</h3>
                        <p class="text-gray-400 text-sm leading-relaxed max-w-lg">Share your unique link. When someone signs up using your link, they get 100 credits and you instantly receive 50 bonus credits.</p>
                        
                        <div class="mt-6 flex items-center max-w-md bg-dark-bg border border-gray-700 rounded-xl overflow-hidden focus-within:border-accent-purple transition-colors">
                            <div class="px-4 text-gray-500 bg-gray-900 border-r border-gray-700 py-3"><i class="fa-solid fa-link"></i></div>
                            <?php $ref_link = "http://localhost/CODEHUB/auth/register.php?ref=" . htmlspecialchars($user['referral_code']); ?>
                            <input type="text" id="ref-link" readonly value="<?php echo $ref_link; ?>" class="w-full bg-transparent text-gray-300 px-4 py-3 text-sm outline-none selection:bg-purple-500/30">
                            <button onclick="copyReferralLink()" class="bg-accent-purple hover:bg-purple-600 text-white px-6 py-3 text-sm font-bold transition-colors">Copy</button>
                        </div>
                        <p id="copy-msg" class="text-green-400 text-xs font-bold mt-2 opacity-0 transition-opacity">Link copied to clipboard!</p>
                    </div>
                </div>

                <div class="bg-dark-card border border-gray-800 rounded-3xl p-8">
                    <h3 class="text-lg font-bold text-white mb-6">Recent Downloads</h3>
                    <div class="text-center py-12 border-2 border-dashed border-gray-700 rounded-2xl bg-dark-bg/50">
                        <div class="w-16 h-16 mx-auto bg-gray-800 rounded-full flex items-center justify-center mb-4 text-gray-500"><i class="fa-solid fa-box-open text-2xl"></i></div>
                        <h4 class="text-white font-bold mb-2">No projects downloaded yet</h4>
                        <a href="../index.php#projects" class="inline-block mt-4 bg-white text-gray-900 hover:bg-gray-200 px-6 py-2.5 rounded-lg text-sm font-bold transition-colors">Browse Catalog</a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-gradient-to-br from-blue-900/20 to-dark-card border border-blue-500/30 rounded-3xl p-6 relative overflow-hidden">
                    <h3 class="text-white font-bold mb-2">Profile Completion</h3>
                    
                    <div class="flex justify-between items-end mb-2">
                        <span class="text-3xl font-extrabold text-accent-blue"><?php echo $profile_completion; ?>%</span>
                        <span class="text-gray-400 text-xs mb-1">
                            <?php echo $profile_completion >= 100 ? "Complete!" : "Almost there!"; ?>
                        </span>
                    </div>
                    
                    <div class="w-full bg-gray-800 rounded-full h-2.5 mb-5 shadow-inner">
                        <div class="bg-accent-blue h-2.5 rounded-full shadow-[0_0_10px_rgba(59,130,246,0.5)] transition-all duration-1000" style="width: <?php echo $profile_completion; ?>%"></div>
                    </div>
                    
                    <?php if($profile_completion < 100): ?>
                        <p class="text-gray-400 text-xs mb-5">Add your phone, address, and academic record to reach 100%.</p>
                        <button onclick="openProfileModal()" class="w-full bg-accent-blue hover:bg-blue-600 text-white font-bold py-3 rounded-xl transition-all shadow-lg shadow-blue-500/30 flex justify-center items-center group">
                            Update Profile <i class="fa-solid fa-user-pen ml-2 group-hover:scale-110 transition-transform"></i>
                        </button>
                    <?php else: ?>
                        <div class="w-full bg-green-500/10 border border-green-500/30 text-green-400 font-bold py-3 rounded-xl flex justify-center items-center">
                            Profile is 100% Complete <i class="fa-solid fa-check-circle ml-2"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="bg-dark-card border border-gray-800 rounded-3xl p-6">
                    <h3 class="text-lg font-bold text-white mb-6">Account Details</h3>
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-800">
                        <div class="w-14 h-14 bg-gradient-to-br from-accent-blue to-blue-700 text-white rounded-2xl flex items-center justify-center text-xl font-bold shadow-lg">
                            <?php echo strtoupper(substr($user['full_name'], 0, 1)); ?>
                        </div>
                        <div>
                            <p class="text-white font-bold"><?php echo htmlspecialchars($user['full_name']); ?></p>
                            <p class="text-gray-500 text-xs mt-0.5">Member since <?php echo date("M Y", strtotime($user['created_at'])); ?></p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-500 text-xs font-bold uppercase mb-1">Email Address</p>
                            <p class="text-gray-300 text-sm"><?php echo htmlspecialchars($user['email']); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-xs font-bold uppercase mb-1">Account Status</p>
                            <p class="inline-flex items-center text-green-400 text-xs font-bold bg-green-500/10 px-2.5 py-1 rounded-md"><i class="fa-solid fa-circle-check mr-1.5"></i> Verified</p>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-800">
                        <a href="../actions/logout.php" class="w-full flex items-center justify-center gap-2 text-red-500 hover:text-white bg-red-500/10 hover:bg-red-500/80 border border-red-500/20 px-4 py-2.5 rounded-xl text-sm font-bold transition-all">
                            <i class="fa-solid fa-right-from-bracket"></i> Sign Out
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<div id="profileModal" class="fixed inset-0 z-[100] hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeProfileModal()"></div>
    
    <div class="relative w-full max-w-3xl bg-dark-card border border-gray-700 rounded-3xl shadow-2xl m-4 max-h-[90vh] flex flex-col transform transition-all scale-95 opacity-0" id="modalBox">
        
        <div class="flex justify-between items-center p-6 border-b border-gray-800">
            <div>
                <h2 class="text-2xl font-bold text-white">Complete Your Profile</h2>
                <p class="text-gray-400 text-sm">Fill in the details below to reach 100% completion.</p>
            </div>
            <button onclick="closeProfileModal()" class="w-10 h-10 bg-gray-800 hover:bg-red-500/20 text-gray-400 hover:text-red-500 rounded-full flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div class="p-6 overflow-y-auto custom-scrollbar">
            <form action="../actions/process_profile.php" method="POST" enctype="multipart/form-data" class="space-y-8">
                
                <div>
                    <h3 class="text-lg font-bold text-accent-blue border-b border-gray-800 pb-2 mb-5"><i class="fa-solid fa-user-pen mr-2"></i> Personal Information</h3>
                    
                    <div class="mb-6 flex items-center gap-6">
                        <div class="w-20 h-20 bg-dark-bg border border-gray-700 rounded-full flex items-center justify-center overflow-hidden shrink-0 relative group cursor-pointer">
                            <img id="avatar-preview" src="" class="hidden w-full h-full object-cover">
                            <i id="avatar-icon" class="fa-solid fa-camera text-2xl text-gray-500 group-hover:text-white transition-colors"></i>
                            <div class="absolute inset-0 bg-black/50 hidden group-hover:flex items-center justify-center transition-all">
                                <span class="text-[10px] text-white font-bold uppercase">Upload</span>
                            </div>
                            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(this)">
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">Profile Picture</p>
                            <p class="text-gray-500 text-xs">JPG, PNG or GIF. Max size 2MB.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Phone Number</label>
                            <div class="flex">
                                <select name="country_code" class="bg-gray-900 border border-gray-700 border-r-0 text-white rounded-l-xl focus:ring-accent-blue focus:border-accent-blue px-3 py-3 text-sm outline-none w-32 shrink-0">
                                    <option value="+92">🇵🇰 +92 (PK)</option>
                                    <option value="+91">🇮🇳 +91 (IN)</option>
                                    <option value="+1">🇺🇸 +1 (US/CA)</option>
                                    <option value="+44">🇬🇧 +44 (UK)</option>
                                    <option value="+971">🇦🇪 +971 (AE)</option>
                                    <option value="+966">🇸🇦 +966 (SA)</option>
                                    <option value="+61">🇦🇺 +61 (AU)</option>
                                    <option value="+880">🇧🇩 +880 (BD)</option>
                                </select>
                                <input type="text" name="phone" class="w-full bg-dark-bg/50 border border-gray-700 text-white rounded-r-xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue px-4 py-3 text-sm transition-all outline-none" placeholder="300 1234567">
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Street Address</label>
                            <input type="text" name="address" class="w-full bg-dark-bg/50 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent-blue px-4 py-3 text-sm outline-none" placeholder="House 123, Street 4, Phase 1">
                        </div>
                        
                        <div>
                            <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">City</label>
                            <input type="text" name="city" class="w-full bg-dark-bg/50 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent-blue px-4 py-3 text-sm outline-none" placeholder="e.g. Lahore">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Postal / Zip Code</label>
                            <input type="text" name="postal_code" class="w-full bg-dark-bg/50 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent-blue px-4 py-3 text-sm outline-none" placeholder="e.g. 54000">
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-accent-purple border-b border-gray-800 pb-2 mb-5 flex items-center">
                        <i class="fa-solid fa-user-graduate mr-2"></i> Academic Record
                    </h3>

                    <label class="flex items-center cursor-pointer mb-5 group">
                        <div class="relative flex items-center justify-center w-6 h-6 mr-3 border-2 border-gray-600 rounded bg-dark-bg group-hover:border-accent-purple transition-colors">
                            <input type="checkbox" id="educated-checkbox" class="opacity-0 absolute w-full h-full cursor-pointer z-10">
                            <i class="fa-solid fa-check text-accent-purple text-xs opacity-0 transition-opacity" id="checkbox-icon"></i>
                        </div>
                        <span class="text-gray-300 font-medium">I want to add my educational background (Optional)</span>
                    </label>

                    <div id="education-fields" class="hidden space-y-5 bg-gray-900/30 border border-gray-800 p-5 rounded-2xl">
                        
                        <div>
                            <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Highest Education Level</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <select id="edu-level" name="education_level" class="w-full bg-dark-bg/50 border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent-purple px-11 py-3 text-sm outline-none appearance-none">
                                    <option value="" disabled selected>Select Level...</option>
                                    <option value="matric">Matriculation / O-Levels</option>
                                    <option value="inter">Intermediate / A-Levels</option>
                                    <option value="bs">BS / Bachelor's Degree</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-500">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div id="bs-fields" class="hidden grid grid-cols-1 md:grid-cols-2 gap-5 pt-3 border-t border-gray-800">
                            <div>
                                <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Study Status</label>
                                <select name="bs_status" class="w-full bg-dark-bg border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent-purple px-4 py-3 text-sm outline-none">
                                    <option value="enrolled">Currently Enrolled</option>
                                    <option value="graduated">Graduated / Completed</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Academic Year</label>
                                <select name="bs_year" class="w-full bg-dark-bg border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent-purple px-4 py-3 text-sm outline-none">
                                    <option value="1">1st Year (Freshman)</option>
                                    <option value="2">2nd Year (Sophomore)</option>
                                    <option value="3">3rd Year (Junior)</option>
                                    <option value="4">4th Year (Senior)</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="p-6 border-t border-gray-800 bg-gray-900/50 rounded-b-3xl flex justify-end gap-3 -mx-6 -mb-6 mt-6">
                    <button type="button" onclick="closeProfileModal()" class="px-6 py-2.5 rounded-xl font-bold text-gray-400 hover:text-white hover:bg-gray-800 transition-colors">Cancel</button>
                    <button type="submit" class="bg-accent-blue hover:bg-blue-600 text-white px-8 py-2.5 rounded-xl font-bold shadow-lg shadow-blue-500/30 transition-all flex items-center">
                        Save & Complete 100% <i class="fa-solid fa-check ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
</style>

<script>
    function copyReferralLink() {
        var copyText = document.getElementById("ref-link");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value).then(function() {
            var msg = document.getElementById("copy-msg");
            msg.classList.remove("opacity-0");
            setTimeout(function() { msg.classList.add("opacity-0"); }, 2000);
        });
    }

    const modal = document.getElementById('profileModal');
    const modalBox = document.getElementById('modalBox');

    function openProfileModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modalBox.classList.remove('scale-95', 'opacity-0');
            modalBox.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeProfileModal() {
        modalBox.classList.remove('scale-100', 'opacity-100');
        modalBox.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    function previewImage(input) {
        const preview = document.getElementById('avatar-preview');
        const icon = document.getElementById('avatar-icon');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                icon.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    const eduCheckbox = document.getElementById('educated-checkbox');
    const checkboxIcon = document.getElementById('checkbox-icon');
    const eduFields = document.getElementById('education-fields');
    const eduLevel = document.getElementById('edu-level');
    const bsFields = document.getElementById('bs-fields');

    eduCheckbox.addEventListener('change', function() {
        if(this.checked) {
            checkboxIcon.classList.remove('opacity-0');
            eduFields.classList.remove('hidden');
        } else {
            checkboxIcon.classList.add('opacity-0');
            eduFields.classList.add('hidden');
            eduLevel.value = "";
            bsFields.classList.add('hidden');
        }
    });

    eduLevel.addEventListener('change', function() {
        if(this.value === 'bs') {
            bsFields.classList.remove('hidden');
        } else {
            bsFields.classList.add('hidden');
        }
    });
</script>

<?php include '../includes/footer.php'; ?>