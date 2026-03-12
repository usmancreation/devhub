<?php
session_start();

// Security Check
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../config/db_connect.php';

// User ke taza credits fetch karein
try {
    $stmt = $pdo->prepare("SELECT credits, full_name FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    if($user) {
        $_SESSION['credits'] = $user['credits'];
    }
} catch (PDOException $e) {
    die("Database Error");
}

$current_credits = $_SESSION['credits'] ?? 0;
$cost_per_prompt = 5;

include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#0a0f1c] relative py-4 sm:py-8 px-2 sm:px-6 lg:px-8">
    
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-900/10 rounded-full blur-[120px] -z-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-6 h-[85vh] min-h-[600px] max-h-[900px]">
        
        <div class="hidden lg:flex w-1/3 xl:w-1/4 flex-col gap-6 h-full overflow-y-auto custom-scrollbar pr-2 pb-2">
            
            <div class="bg-dark-card border border-gray-800 rounded-[2rem] p-6 shadow-lg shrink-0">
                <a href="all_tools.php" class="text-gray-400 hover:text-accent-blue text-sm font-medium transition-colors mb-4 inline-flex items-center">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back to Tools
                </a>
                
                <div class="w-14 h-14 rounded-2xl bg-blue-500/10 flex items-center justify-center border border-blue-500/20 mb-4 shadow-inner">
                    <i class="fa-solid fa-robot text-2xl text-blue-400"></i>
                </div>
                <h1 class="text-xl font-extrabold text-white mb-2">AI Chat Assistant</h1>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Your personal coding and logic assistant. Ask anything, paste code to debug, or request new components.
                </p>
            </div>

            <div class="bg-gradient-to-br from-gray-900 to-dark-card border border-gray-800 rounded-[2rem] p-6 relative overflow-hidden group shadow-lg shrink-0">
                <div class="absolute right-0 top-0 text-gray-800 opacity-50 transform translate-x-4 -translate-y-4 text-6xl">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Wallet Balance</h3>
                
                <div class="flex items-end gap-2 mb-4 relative z-10">
                    <span id="desktop-credits" class="text-4xl font-extrabold <?php echo $current_credits >= $cost_per_prompt ? 'text-white' : 'text-red-500'; ?>">
                        <?php echo number_format($current_credits); ?>
                    </span>
                    <span class="text-gray-500 text-sm font-medium mb-1">Credits</span>
                </div>
                
                <?php if($current_credits < $cost_per_prompt): ?>
                    <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-xs p-3 rounded-xl mb-4 font-medium flex items-start">
                        <i class="fa-solid fa-triangle-exclamation mt-0.5 mr-2"></i>
                        Not enough credits. You need <?php echo $cost_per_prompt; ?> credits.
                    </div>
                    <a href="../user/dashboard.php" class="block text-center w-full bg-dark-bg border border-gray-700 hover:border-gray-500 text-white text-sm font-bold py-2.5 rounded-xl transition-all">
                        Get More Credits
                    </a>
                <?php else: ?>
                    <div class="bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs p-3 rounded-xl font-medium flex items-center">
                        <i class="fa-solid fa-bolt text-yellow-500 mr-2"></i>
                        Cost per prompt: <strong><?php echo $cost_per_prompt; ?> Credits</strong>
                    </div>
                <?php endif; ?>
            </div>

            <div class="bg-dark-card border border-gray-800 rounded-[2rem] p-6 shadow-lg shrink-0">
                <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-4"><i class="fa-solid fa-lightbulb text-yellow-500 mr-2"></i> Pro Tips</h3>
                <ul class="text-sm text-gray-500 space-y-3">
                    <li class="flex items-start"><i class="fa-solid fa-check text-green-500 mt-1 mr-2 text-[10px]"></i> Be specific about the language.</li>
                    <li class="flex items-start"><i class="fa-solid fa-check text-green-500 mt-1 mr-2 text-[10px]"></i> Paste your error code to get exact fixes.</li>
                    <li class="flex items-start"><i class="fa-solid fa-check text-green-500 mt-1 mr-2 text-[10px]"></i> Ask it to explain complex concepts.</li>
                </ul>
            </div>
        </div>

        <div class="flex-1 w-full bg-dark-card border border-gray-800 rounded-2xl md:rounded-[2rem] flex flex-col shadow-2xl relative overflow-hidden h-full">
            
            <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-800 bg-gray-900/80 backdrop-blur-md flex justify-between items-center shrink-0 z-10">
                
                <div class="flex items-center gap-3">
                    <a href="all_tools.php" class="lg:hidden w-8 h-8 flex items-center justify-center bg-gray-800 rounded-lg text-gray-400 hover:text-white transition-colors">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                    
                    <div class="relative hidden sm:block">
                        <div class="w-2.5 h-2.5 bg-green-500 rounded-full border-2 border-dark-card absolute -bottom-1 -right-1 z-10"></div>
                        <i class="fa-solid fa-robot text-2xl text-blue-400"></i>
                    </div>
                    
                    <div>
                        <span class="text-white font-bold block leading-tight text-sm md:text-base">DevHub AI Assistant</span>
                        <span class="text-[10px] md:text-xs text-gray-400 lg:hidden flex items-center gap-1 mt-0.5">
                            <i class="fa-solid fa-wallet text-gray-500"></i> 
                            <span id="mobile-credits" class="<?php echo $current_credits >= $cost_per_prompt ? 'text-yellow-500' : 'text-red-500'; ?> font-bold">
                                <?php echo number_format($current_credits); ?>
                            </span> Credits
                        </span>
                    </div>
                </div>

                <button onclick="clearChat()" class="text-gray-400 hover:text-red-400 text-xs sm:text-sm font-medium transition-colors bg-gray-800 hover:bg-gray-700 px-3 py-1.5 rounded-lg flex items-center gap-1.5">
                    <i class="fa-solid fa-trash-can"></i> <span class="hidden sm:inline">Clear</span>
                </button>
            </div>

            <div id="chat-box" class="flex-1 overflow-y-auto p-4 md:p-6 space-y-6 custom-scrollbar scroll-smooth bg-[#0a0f1c]/50">
                
                <div class="flex items-start gap-3 md:gap-4">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-500/10 flex items-center justify-center shrink-0 border border-blue-500/20">
                        <i class="fa-solid fa-robot text-blue-400 text-sm md:text-base"></i>
                    </div>
                    <div class="bg-gray-800/80 border border-gray-700 text-gray-200 px-4 md:px-5 py-3 md:py-3.5 rounded-2xl rounded-tl-sm max-w-[90%] md:max-w-[85%] text-sm leading-relaxed shadow-sm">
                        Hello <strong><?php echo htmlspecialchars(explode(' ', trim($_SESSION['full_name']))[0]); ?></strong>! I'm ready to help you with your code, assignments, or any tech questions. <br><br>
                        <em>Type your prompt below. Each message costs <strong class="text-yellow-500"><?php echo $cost_per_prompt; ?> credits</strong>.</em>
                    </div>
                </div>

            </div>

            <div class="p-3 md:p-4 border-t border-gray-800 bg-dark-card shrink-0">
                
                <?php if($current_credits < $cost_per_prompt): ?>
                    <div class="text-center py-2">
                        <p class="text-red-400 text-sm font-bold mb-2"><i class="fa-solid fa-triangle-exclamation"></i> Out of Credits</p>
                        <a href="../user/dashboard.php" class="inline-block bg-gray-800 hover:bg-gray-700 text-white text-xs px-4 py-2 rounded-lg font-medium transition-colors">
                            Top up to continue chatting
                        </a>
                    </div>
                <?php else: ?>
                    <form id="chat-form" class="relative flex items-end gap-2" onsubmit="handleChatSubmit(event)">
                        <textarea id="prompt-input" rows="1" class="w-full bg-dark-bg border border-gray-700 text-white rounded-xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue pl-4 pr-4 py-3 text-sm transition-all outline-none resize-none custom-scrollbar shadow-inner max-h-[120px]" placeholder="Ask anything..."></textarea>
                        
                        <button type="submit" id="send-btn" class="shrink-0 h-[46px] bg-accent-blue hover:bg-blue-600 disabled:bg-gray-700 disabled:cursor-not-allowed text-white px-4 md:px-6 rounded-xl font-bold transition-all shadow-lg shadow-blue-500/30 flex items-center justify-center group">
                            <i class="fa-solid fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </form>
                    <div class="text-center mt-2 hidden sm:block">
                        <span class="text-[10px] text-gray-500">Press <kbd class="bg-gray-800 px-1 py-0.5 rounded border border-gray-700">Enter</kbd> to send, <kbd class="bg-gray-800 px-1 py-0.5 rounded border border-gray-700">Shift+Enter</kbd> for new line.</span>
                    </div>
                <?php endif; ?>
                
            </div>

        </div>

    </div>
</main>

<style>
    /* REMOVED: body { overflow: hidden; } - Now standard scrolling works */
    
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
    
    .typing-dot { animation: typing 1.4s infinite ease-in-out both; }
    .typing-dot:nth-child(1) { animation-delay: -0.32s; }
    .typing-dot:nth-child(2) { animation-delay: -0.16s; }
    @keyframes typing { 0%, 80%, 100% { transform: scale(0); } 40% { transform: scale(1); } }
</style>

<script>
    // Textarea Auto-resize
    const textarea = document.getElementById('prompt-input');
    if(textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight < 120 ? this.scrollHeight : 120) + 'px';
        });

        // Submit on Enter
        textarea.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey && window.innerWidth > 640) {
                e.preventDefault();
                if(!document.getElementById('send-btn').disabled) {
                    document.getElementById('chat-form').dispatchEvent(new Event('submit'));
                }
            }
        });
    }

    const chatBox = document.getElementById('chat-box');
    const sendBtn = document.getElementById('send-btn');
    let currentCredits = <?php echo $current_credits; ?>;
    const cost = <?php echo $cost_per_prompt; ?>;

    function handleChatSubmit(e) {
        e.preventDefault();
        const prompt = textarea.value.trim();
        if(!prompt) return;

        appendMessage('user', prompt);
        textarea.value = '';
        textarea.style.height = 'auto'; 
        
        textarea.disabled = true;
        sendBtn.disabled = true;

        const loadingId = appendLoading();

        // AJAX to Backend API
        fetch('../actions/process_ai_chat.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'prompt=' + encodeURIComponent(prompt)
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById(loadingId).remove();

            if(data.status === 'success') {
                appendMessage('ai', data.response);
                
                // Update Credits UI (Desktop & Mobile)
                currentCredits = data.new_credits;
                if(document.getElementById('desktop-credits')) {
                    document.getElementById('desktop-credits').innerText = currentCredits.toLocaleString();
                }
                if(document.getElementById('mobile-credits')) {
                    document.getElementById('mobile-credits').innerText = currentCredits.toLocaleString();
                }
                
                // Stop input if out of credits
                if(currentCredits < cost) {
                    location.reload(); // Reload to show out of credits UI
                }
            } else {
                appendMessage('error', data.message);
            }
        })
        .catch(error => {
            document.getElementById(loadingId).remove();
            appendMessage('error', "Connection error. Please try again.");
        })
        .finally(() => {
            if(currentCredits >= cost) {
                textarea.disabled = false;
                sendBtn.disabled = false;
                textarea.focus();
            }
            scrollToBottom();
        });
    }

    function appendMessage(sender, text) {
        const div = document.createElement('div');
        div.className = 'flex items-start gap-3 md:gap-4 ' + (sender === 'user' ? 'flex-row-reverse' : '');
        
        let avatar = '';
        let bubbleStyle = '';

        if(sender === 'user') {
            avatar = `<div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gray-800 flex items-center justify-center shrink-0 border border-gray-700 shadow-md">
                        <span class="text-white font-bold text-xs md:text-sm"><?php echo strtoupper(substr($_SESSION['full_name'], 0, 1)); ?></span>
                      </div>`;
            bubbleStyle = 'bg-accent-blue text-white rounded-tr-sm shadow-md';
        } else if(sender === 'ai') {
            avatar = `<div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-500/10 flex items-center justify-center shrink-0 border border-blue-500/20 shadow-sm">
                        <i class="fa-solid fa-robot text-blue-400 text-sm md:text-base"></i>
                      </div>`;
            bubbleStyle = 'bg-gray-800/80 border border-gray-700 text-gray-200 rounded-tl-sm shadow-sm';
            text = text.replace(/\n/g, '<br>');
        } else if(sender === 'error') {
            avatar = `<div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-red-500/10 flex items-center justify-center shrink-0 border border-red-500/20">
                        <i class="fa-solid fa-triangle-exclamation text-red-500 text-sm md:text-base"></i>
                      </div>`;
            bubbleStyle = 'bg-red-500/10 border border-red-500/30 text-red-400 rounded-tl-sm font-medium';
        }

        div.innerHTML = `
            ${avatar}
            <div class="${bubbleStyle} px-4 md:px-5 py-3 md:py-3.5 rounded-2xl max-w-[90%] md:max-w-[85%] text-sm leading-relaxed overflow-x-auto">
                ${text}
            </div>
        `;
        chatBox.appendChild(div);
        scrollToBottom();
    }

    function appendLoading() {
        const id = 'loading-' + Date.now();
        const div = document.createElement('div');
        div.id = id;
        div.className = 'flex items-start gap-3 md:gap-4';
        div.innerHTML = `
            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-500/10 flex items-center justify-center shrink-0 border border-blue-500/20 shadow-sm">
                <i class="fa-solid fa-robot text-blue-400 text-sm md:text-base"></i>
            </div>
            <div class="bg-gray-800/80 border border-gray-700 text-gray-200 px-4 md:px-5 py-4 rounded-2xl rounded-tl-sm flex items-center gap-1.5 shadow-sm">
                <div class="w-2 h-2 bg-blue-400 rounded-full typing-dot"></div>
                <div class="w-2 h-2 bg-blue-400 rounded-full typing-dot"></div>
                <div class="w-2 h-2 bg-blue-400 rounded-full typing-dot"></div>
            </div>
        `;
        chatBox.appendChild(div);
        scrollToBottom();
        return id;
    }

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function clearChat() {
        if(confirm("Clear conversation?")) {
            const firstMsg = chatBox.firstElementChild;
            chatBox.innerHTML = '';
            if(firstMsg) chatBox.appendChild(firstMsg);
        }
    }
</script>

<?php include '../includes/footer.php'; ?>