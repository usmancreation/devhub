<?php 
session_start();

// Agar session mein verify_email nahi hai, toh iska matlab user direct is link par aaya hai
if (!isset($_SESSION['verify_email'])) {
    header("Location: register.php");
    exit();
}

// Session se real email fetch karein
$user_email = $_SESSION['verify_email'];

// Header Include
include '../includes/header.php';
?>

<main class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <div class="absolute top-1/4 right-1/4 w-72 h-72 bg-accent-blue/10 rounded-full blur-[100px] -z-10"></div>
    <div class="absolute bottom-1/4 left-1/4 w-72 h-72 bg-accent-purple/10 rounded-full blur-[100px] -z-10"></div>

    <div class="max-w-md w-full bg-dark-card border border-gray-800 rounded-3xl shadow-2xl p-8 relative z-10 text-center">
        
        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-full flex items-center justify-center mb-6 shadow-inner border border-blue-500/30">
            <i class="fa-solid fa-envelope-open-text text-3xl text-accent-blue"></i>
        </div>

        <h2 class="text-3xl font-extrabold text-white mb-3">Check your email</h2>
        <p class="text-gray-400 text-sm mb-6 leading-relaxed">
            We've sent a secure 6-digit verification code to <br>
            <span class="text-white font-semibold"><?php echo htmlspecialchars($user_email); ?></span>. <br>
            Please enter it below to activate your account.
        </p>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-red-500/10 border border-red-500/50 text-red-500 px-4 py-2 rounded-lg mb-6 text-sm">
                <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']); // Error dikhane ke baad remove kar dein
                ?>
            </div>
        <?php endif; ?>

        <form action="../actions/process_otp.php" method="POST" id="otp-form" class="space-y-6">
            
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($user_email); ?>">
            <input type="hidden" name="otp_code" id="final_otp_code">

            <div class="flex justify-center gap-2 sm:gap-3" id="otp-inputs">
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-2xl font-extrabold text-white bg-dark-bg border border-gray-700 rounded-xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all shadow-inner" autofocus>
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-2xl font-extrabold text-white bg-dark-bg border border-gray-700 rounded-xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all shadow-inner">
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-2xl font-extrabold text-white bg-dark-bg border border-gray-700 rounded-xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all shadow-inner">
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-2xl font-extrabold text-white bg-dark-bg border border-gray-700 rounded-xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all shadow-inner">
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-2xl font-extrabold text-white bg-dark-bg border border-gray-700 rounded-xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all shadow-inner">
                <input type="text" maxlength="1" class="w-12 h-14 text-center text-2xl font-extrabold text-white bg-dark-bg border border-gray-700 rounded-xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all shadow-inner">
            </div>

            <button type="submit" class="w-full bg-accent-blue hover:bg-blue-600 text-white font-bold py-4 px-4 rounded-xl transition-all shadow-lg shadow-blue-500/30 mt-4 flex justify-center items-center group">
                Verify & Create Account <i class="fa-solid fa-check-circle ml-2 group-hover:scale-110 transition-transform"></i>
            </button>
        </form>

        <div class="mt-8 text-sm">
            <p class="text-gray-500">
                Didn't receive the code? 
                <button id="resend-btn" class="text-gray-400 cursor-not-allowed font-medium transition-colors ml-1" disabled>
                    Resend Code <span id="timer">(00:59)</span>
                </button>
            </p>
        </div>

    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- OTP Input Auto-Focus Logic ---
        const inputs = document.querySelectorAll('#otp-inputs input');
        const hiddenInput = document.getElementById('final_otp_code');

        inputs.forEach((input, index) => {
            input.addEventListener('keyup', (e) => {
                const currentInput = input;
                const nextInput = input.nextElementSibling;
                const prevInput = input.previousElementSibling;

                // Combine all input values into the hidden input
                let otpString = '';
                inputs.forEach(inp => otpString += inp.value);
                hiddenInput.value = otpString;

                // Move to next if a number is entered
                if (currentInput.value.length > 0 && nextInput) {
                    nextInput.focus();
                }

                // Move to previous on Backspace
                if (e.key === "Backspace" && prevInput) {
                    prevInput.focus();
                }
            });
            
            // Restrict to numbers only
            input.addEventListener('keypress', function(e) {
                if (e.which < 48 || e.which > 57) {
                    e.preventDefault();
                }
            });
        });

        // --- Resend Timer Logic ---
        let timeLeft = 59;
        const timerElement = document.getElementById('timer');
        const resendBtn = document.getElementById('resend-btn');

        const countdown = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(countdown);
                timerElement.innerHTML = "";
                resendBtn.classList.remove('text-gray-400', 'cursor-not-allowed');
                resendBtn.classList.add('text-accent-blue', 'hover:text-blue-400', 'cursor-pointer');
                resendBtn.disabled = false;
            } else {
                let displayTime = timeLeft < 10 ? "0" + timeLeft : timeLeft;
                timerElement.innerHTML = "(00:" + displayTime + ")";
                timeLeft -= 1;
            }
        }, 1000);
    });
</script>

<?php 
// Footer Include
include '../includes/footer.php';
?>