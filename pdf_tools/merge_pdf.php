<?php
session_start();
$base_url = "/CODEHUB/"; 
include '../includes/header.php'; 
?>

<main class="min-h-screen bg-[#0a0f1c] relative pb-24 overflow-hidden">
    
    <div class="absolute top-0 inset-x-0 h-[400px] bg-gradient-to-b from-blue-900/20 to-transparent pointer-events-none z-0"></div>
    <div class="absolute top-1/4 left-0 w-96 h-96 bg-blue-600/5 rounded-full blur-[120px] pointer-events-none z-0"></div>
    <div class="absolute bottom-1/4 right-0 w-96 h-96 bg-purple-600/5 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 md:pt-12 relative z-10 flex flex-col min-h-[85vh]">
        
        <div class="text-center mb-10">
            <a href="index.php" class="inline-flex items-center text-gray-400 hover:text-white transition-colors text-xs md:text-sm font-medium mb-6 bg-dark-card border border-gray-800 hover:border-gray-600 px-4 py-2 rounded-full shadow-sm">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Tools
            </a>
            
            <div class="w-16 h-16 md:w-20 md:h-20 bg-blue-500/10 border border-blue-500/20 rounded-[2rem] flex items-center justify-center mx-auto mb-5 shadow-inner shadow-blue-500/10">
                <i class="fa-solid fa-object-group text-3xl md:text-4xl text-accent-blue"></i>
            </div>
            
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white mb-4 tracking-tight">Merge PDF Files</h1>
            <p class="text-gray-400 text-sm md:text-base max-w-xl mx-auto leading-relaxed">
                Combine multiple PDFs into one single file easily. <br class="hidden sm:block"> No limits, no watermarks, completely free and secure.
            </p>
        </div>

        <form action="../actions/process_pdf_merge.php" method="POST" enctype="multipart/form-data" id="upload-form" class="w-full flex-1 flex flex-col">
            
            <div id="drop-zone" class="w-full bg-dark-card/40 backdrop-blur-xl border-2 border-dashed border-gray-700 hover:border-accent-blue hover:bg-blue-900/10 rounded-[2.5rem] p-8 md:p-14 text-center transition-all duration-300 relative group cursor-pointer shadow-lg mb-8">
                
                <input type="file" name="pdfs[]" id="file-input" multiple accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                
                <div class="pointer-events-none flex flex-col items-center">
                    <div class="w-20 h-20 bg-gray-800/80 rounded-full flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-accent-blue transition-all duration-500 shadow-xl border border-gray-700 group-hover:border-blue-400">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-2 group-hover:text-accent-blue transition-colors">Choose PDF files</h3>
                    <p class="text-gray-500 text-sm font-medium">or drag & drop them here</p>
                </div>
            </div>

            <div id="file-preview-container" class="hidden mb-10 flex-1">
                <div class="flex justify-between items-end mb-4 px-2 border-b border-gray-800 pb-3">
                    <div>
                        <h4 class="text-white font-bold text-sm md:text-base flex items-center gap-2">
                            Selected Files 
                            <span id="file-count" class="bg-accent-blue text-white text-[10px] px-2 py-0.5 rounded-full font-bold">0</span>
                        </h4>
                    </div>
                    <button type="button" id="clear-files" class="text-gray-400 hover:text-red-400 text-xs font-bold transition-colors flex items-center bg-gray-800/50 hover:bg-red-500/10 px-3 py-1.5 rounded-lg border border-gray-700 hover:border-red-500/30">
                        <i class="fa-solid fa-trash-can mr-1.5"></i> Clear All
                    </button>
                </div>
                
                <div id="file-list" class="space-y-3 max-h-[350px] overflow-y-auto custom-scrollbar pr-2 pb-4"></div>
            </div>

            <div class="mt-auto bg-dark-card/90 backdrop-blur-xl border border-gray-800 rounded-3xl p-5 md:p-6 flex flex-col sm:flex-row justify-between items-center gap-4 sticky bottom-4 md:bottom-6 shadow-[0_-10px_40px_-10px_rgba(0,0,0,0.5)] z-50 transition-all">
                <div class="text-center sm:text-left">
                    <p class="text-gray-300 text-sm font-bold flex items-center justify-center sm:justify-start">
                        <i class="fa-solid fa-shield-check text-green-500 mr-2 text-lg"></i> Secure Processing
                    </p>
                    <p class="text-gray-500 text-xs mt-1">Files are deleted instantly after merging.</p>
                </div>
                
                <button type="submit" id="merge-btn" disabled class="w-full sm:w-auto bg-accent-blue hover:bg-blue-600 disabled:bg-gray-800 disabled:border-gray-700 disabled:text-gray-500 disabled:cursor-not-allowed disabled:shadow-none text-white font-extrabold py-4 px-10 rounded-2xl transition-all shadow-lg shadow-blue-500/25 flex items-center justify-center group border border-blue-500 hover:border-blue-400 text-lg">
                    Merge PDFs <i class="fa-solid fa-arrow-right-long ml-3 group-hover:translate-x-2 transition-transform"></i>
                </button>
            </div>

        </form>

    </div>
</main>

<style>
    /* Drag over active state matching the DevHub blue theme */
    .drag-over {
        border-color: #3b82f6 !important; /* Tailwind accent-blue */
        background-color: rgba(59, 130, 246, 0.08) !important;
    }
    
    /* Elegant scrollbar for file list */
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }

    /* Card Entry Animation */
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-file-card {
        animation: slideIn 0.3s ease-out forwards;
    }
</style>

<script>
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const filePreviewContainer = document.getElementById('file-preview-container');
    const fileList = document.getElementById('file-list');
    const fileCountSpan = document.getElementById('file-count');
    const mergeBtn = document.getElementById('merge-btn');
    const clearBtn = document.getElementById('clear-files');

    let selectedFiles = [];

    // --- Drag & Drop Visual Effects ---
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.add('drag-over'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.remove('drag-over'), false);
    });

    // --- Handle File Selection ---
    dropZone.addEventListener('drop', (e) => {
        let dt = e.dataTransfer;
        let files = dt.files;
        handleFiles(files);
    });

    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        // Filter only PDFs
        const newPdfs = Array.from(files).filter(file => file.type === 'application/pdf');
        
        if(newPdfs.length === 0) {
            alert('Please select valid PDF files only.');
            return;
        }

        selectedFiles = [...selectedFiles, ...newPdfs];
        renderFileList();
    }

    // --- Render UI ---
    function renderFileList() {
        fileList.innerHTML = '';
        
        if(selectedFiles.length > 0) {
            // Adjust UI Layout to accommodate list
            dropZone.classList.remove('p-8', 'md:p-14');
            dropZone.classList.add('p-6', 'md:p-8');
            dropZone.querySelector('i').classList.replace('text-3xl', 'text-2xl');
            dropZone.querySelector('.w-20').classList.replace('w-20', 'w-14');
            dropZone.querySelector('.h-20').classList.replace('h-20', 'h-14');
            dropZone.querySelector('h3').classList.replace('text-xl', 'text-lg');
            dropZone.querySelector('h3').classList.replace('md:text-2xl', 'md:text-xl');

            filePreviewContainer.classList.remove('hidden');
            fileCountSpan.innerText = selectedFiles.length;
            
            // Enable button ONLY if 2 or more PDFs are selected
            if(selectedFiles.length > 1) {
                mergeBtn.disabled = false;
            } else {
                mergeBtn.disabled = true;
            }

            selectedFiles.forEach((file, index) => {
                // Calculate size in KB/MB
                let size = (file.size / 1024).toFixed(1) + ' KB';
                if(file.size > 1024 * 1024) {
                    size = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                }

                const fileItem = document.createElement('div');
                fileItem.className = 'bg-dark-bg border border-gray-800 hover:border-blue-500/30 p-3.5 rounded-2xl flex items-center justify-between animate-file-card transition-colors group';
                fileItem.innerHTML = `
                    <div class="flex items-center gap-4 overflow-hidden w-full pr-4">
                        <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center shrink-0 border border-blue-500/20 group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-file-pdf text-accent-blue"></i>
                        </div>
                        <div class="truncate flex-1">
                            <p class="text-white text-sm font-bold truncate group-hover:text-blue-400 transition-colors">${file.name}</p>
                            <p class="text-gray-500 text-xs mt-0.5">${size}</p>
                        </div>
                    </div>
                    <button type="button" onclick="removeFile(${index})" title="Remove file" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-red-400 hover:bg-red-500/10 rounded-xl transition-all shrink-0">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                `;
                fileList.appendChild(fileItem);
            });
        } else {
            // Revert UI Layout
            dropZone.classList.add('p-8', 'md:p-14');
            dropZone.classList.remove('p-6', 'md:p-8');
            dropZone.querySelector('i').classList.replace('text-2xl', 'text-3xl');
            dropZone.querySelector('.w-14').classList.replace('w-14', 'w-20');
            dropZone.querySelector('.h-14').classList.replace('h-14', 'h-20');
            dropZone.querySelector('h3').classList.replace('text-lg', 'text-xl');
            dropZone.querySelector('h3').classList.replace('md:text-xl', 'md:text-2xl');

            filePreviewContainer.classList.add('hidden');
            mergeBtn.disabled = true;
        }
    }

    // --- Remove individual file ---
    window.removeFile = function(index) {
        selectedFiles.splice(index, 1);
        
        // Re-sync with hidden input
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;

        renderFileList();
    }

    // --- Clear All ---
    clearBtn.addEventListener('click', () => {
        selectedFiles = [];
        fileInput.value = ""; 
        renderFileList();
    });

</script>

<?php include '../includes/footer.php'; ?>