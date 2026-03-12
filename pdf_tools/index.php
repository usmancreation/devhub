<?php
session_start();
$base_url = "/CODEHUB/"; 
include '../includes/header.php'; 

// Array of all PDF Tools categorized with specific Colors matching your screenshot
$pdf_categories = [
    'Organize PDF' => [
        ['title' => 'Merge PDF', 'desc' => 'Combine multiple PDFs into one unified document.', 'icon' => 'fa-object-group', 'color' => 'red', 'link' => 'merge_pdf.php'],
        ['title' => 'Split PDF', 'desc' => 'Extract pages or split a PDF into multiple files.', 'icon' => 'fa-scissors', 'color' => 'orange', 'link' => 'split_pdf.php'],
        ['title' => 'Remove Pages', 'desc' => 'Delete unwanted pages from your PDF file.', 'icon' => 'fa-file-circle-minus', 'color' => 'rose', 'link' => 'remove_pages.php'],
        ['title' => 'Extract Pages', 'desc' => 'Get a new document containing only the desired pages.', 'icon' => 'fa-file-export', 'color' => 'pink', 'link' => 'extract_pages.php'],
        ['title' => 'Organize PDF', 'desc' => 'Sort, add and delete PDF pages.', 'icon' => 'fa-arrow-down-a-z', 'color' => 'fuchsia', 'link' => 'organize_pdf.php'],
        ['title' => 'Scan to PDF', 'desc' => 'Capture document scans and turn them into PDFs.', 'icon' => 'fa-print', 'color' => 'purple', 'link' => 'scan_to_pdf.php'],
    ],
    'Optimize PDF' => [
        ['title' => 'Compress PDF', 'desc' => 'Reduce file size while optimizing for maximal PDF quality.', 'icon' => 'fa-compress', 'color' => 'emerald', 'link' => 'compress_pdf.php'],
        ['title' => 'Repair PDF', 'desc' => 'Fix a corrupted, broken or missing PDF file.', 'icon' => 'fa-wrench', 'color' => 'teal', 'link' => 'repair_pdf.php'],
        ['title' => 'OCR PDF', 'desc' => 'Make text in scanned PDFs selectable and searchable.', 'icon' => 'fa-eye', 'color' => 'cyan', 'link' => 'ocr_pdf.php'],
    ],
    'Convert to PDF' => [
        ['title' => 'JPG to PDF', 'desc' => 'Convert JPG images to PDF in seconds.', 'icon' => 'fa-image', 'color' => 'orange', 'link' => 'jpg_to_pdf.php'],
        ['title' => 'Word to PDF', 'desc' => 'Make DOC files easy to read by converting them to PDF.', 'icon' => 'fa-file-word', 'color' => 'blue', 'link' => 'word_to_pdf.php'],
        ['title' => 'PowerPoint to PDF', 'desc' => 'Make PPT slideshows easy to view by converting them.', 'icon' => 'fa-file-powerpoint', 'color' => 'orange', 'link' => 'ppt_to_pdf.php'],
        ['title' => 'Excel to PDF', 'desc' => 'Make EXCEL spreadsheets easy to read by converting them.', 'icon' => 'fa-file-excel', 'color' => 'green', 'link' => 'excel_to_pdf.php'],
        ['title' => 'HTML to PDF', 'desc' => 'Convert webpages in HTML to PDF.', 'icon' => 'fa-code', 'color' => 'sky', 'link' => 'html_to_pdf.php'],
    ],
    'Convert from PDF' => [
        ['title' => 'PDF to JPG', 'desc' => 'Extract images or convert each page to a high-res JPG.', 'icon' => 'fa-file-image', 'color' => 'orange', 'link' => 'pdf_to_jpg.php'],
        ['title' => 'PDF to Word', 'desc' => 'Convert PDF documents into editable Word (.docx) files.', 'icon' => 'fa-file-word', 'color' => 'blue', 'link' => 'pdf_to_word.php'],
        ['title' => 'PDF to PowerPoint', 'desc' => 'Turn your PDF files into easy to edit PPT slideshows.', 'icon' => 'fa-file-powerpoint', 'color' => 'orange', 'link' => 'pdf_to_ppt.php'],
        ['title' => 'PDF to Excel', 'desc' => 'Extract tabular data straight from PDFs into EXCEL.', 'icon' => 'fa-file-excel', 'color' => 'green', 'link' => 'pdf_to_excel.php'],
        ['title' => 'Image to PDF', 'desc' => 'Merge multiple JPG or PNG images into a single document.', 'icon' => 'fa-images', 'color' => 'purple', 'link' => 'image_to_pdf.php'],
    ],
    'Edit PDF' => [
        ['title' => 'Rotate PDF', 'desc' => 'Rotate your PDFs the way you need them.', 'icon' => 'fa-rotate', 'color' => 'indigo', 'link' => 'rotate_pdf.php'],
        ['title' => 'Add Page Numbers', 'desc' => 'Add page numbers into PDFs with ease.', 'icon' => 'fa-list-ol', 'color' => 'violet', 'link' => 'add_page_numbers.php'],
        ['title' => 'Add Watermark', 'desc' => 'Stamp an image or text over your PDF in seconds.', 'icon' => 'fa-stamp', 'color' => 'fuchsia', 'link' => 'add_watermark.php'],
        ['title' => 'Crop PDF', 'desc' => 'Trim PDF margins, change PDF page size.', 'icon' => 'fa-crop-simple', 'color' => 'pink', 'link' => 'crop_pdf.php'],
    ],
    'PDF Security' => [
        ['title' => 'Unlock PDF', 'desc' => 'Remove PDF password security.', 'icon' => 'fa-lock-open', 'color' => 'emerald', 'link' => 'unlock_pdf.php'],
        ['title' => 'Protect PDF', 'desc' => 'Encrypt your PDF with a strong password.', 'icon' => 'fa-lock', 'color' => 'red', 'link' => 'protect_pdf.php'],
        ['title' => 'Sign PDF', 'desc' => 'Sign yourself or request electronic signatures.', 'icon' => 'fa-signature', 'color' => 'blue', 'link' => 'sign_pdf.php'],
    ],
];
?>

<style>
    /* Custom cursor blinking for dynamic typing */
    #typewriter {
        border-right: 4px solid #ef4444; /* Red cursor to match PDF theme */
        animation: blink-caret 0.75s step-end infinite;
        padding-right: 4px;
    }
    @keyframes blink-caret {
        from, to { border-color: transparent; }
        50% { border-color: #ef4444; }
    }
    
    /* Gradient text for typewriter */
    .gradient-text-pdf {
        background: linear-gradient(to right, #ef4444, #f97316);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Staggered Entry Animation for Cards */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-card {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    /* Scrollbar hide for tabs */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<main class="min-h-screen bg-[#0a0f1c] relative pb-20 overflow-hidden">
    
    <div class="absolute top-0 inset-x-0 h-[500px] bg-gradient-to-b from-blue-900/10 to-transparent pointer-events-none z-0"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTU5LjkgMEw1OS45IDYwTDAgNjBMMCA1OS45TDU5LjkgNTkuOVoiIGZpbGw9Im5vbmUiIHN0cm9rZT0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjAzKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9zdmc+')] opacity-40 pointer-events-none z-0"></div>

    <div class="pt-16 pb-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center relative z-10">
        
        <h1 class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight mb-4 flex flex-col items-center justify-center tracking-tight">
            <span>Every tool you need to</span>
            <div class="mt-2 flex items-center justify-center h-12 sm:h-16">
                <span>work with&nbsp;</span>
                <span id="typewriter" class="gradient-text-pdf uppercase tracking-wide"></span>
            </div>
        </h1>
        
        <p class="text-gray-400 text-sm md:text-lg max-w-2xl mx-auto mb-10 leading-relaxed px-2">
            100% FREE, easy to use, and secure. Merge, split, compress, convert, rotate, unlock and watermark PDFs with just a few clicks.
        </p>

        <div class="max-w-2xl mx-auto relative group px-2">
            <div class="absolute inset-y-0 left-4 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-accent-blue transition-colors">
                <i class="fa-solid fa-magnifying-glass text-lg"></i>
            </div>
            <input type="text" id="search-input" class="w-full bg-dark-card/80 backdrop-blur-xl border border-gray-700 text-white rounded-2xl focus:ring-2 focus:ring-accent-blue focus:border-accent-blue pl-14 pr-6 py-4 md:py-5 text-sm md:text-base transition-all outline-none shadow-2xl" placeholder="Search for a PDF tool (e.g. Merge, Convert to Word)...">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 mt-6">
        
        <div class="flex overflow-x-auto no-scrollbar gap-3 pb-6 mb-6 justify-start lg:justify-center px-2">
            <button onclick="filterCategory('All')" class="tab-btn active shrink-0 px-6 py-3 rounded-full text-sm font-bold transition-all bg-accent-blue text-white shadow-lg shadow-blue-500/30 border border-blue-500">
                All Tools
            </button>
            <?php foreach(array_keys($pdf_categories) as $cat_name): ?>
                <button onclick="filterCategory('<?php echo htmlspecialchars($cat_name, ENT_QUOTES); ?>')" class="tab-btn shrink-0 px-6 py-3 rounded-full text-sm font-medium transition-all bg-dark-card/80 backdrop-blur-sm border border-gray-700 text-gray-400 hover:text-white hover:border-gray-500 hover:bg-gray-800">
                    <?php echo $cat_name; ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="tools-grid">
            
            <?php 
            $delay_count = 0;
            foreach($pdf_categories as $category => $tools): 
                foreach($tools as $tool): 
                    $delay = ($delay_count % 12) * 0.05; // Staggered animation delay
                    $delay_count++;
            ?>
                    
                    <a href="<?php echo $tool['link']; ?>" 
                       style="animation-delay: <?php echo $delay; ?>s;"
                       class="tool-card animate-card group relative bg-dark-card/60 backdrop-blur-xl border border-gray-800 hover:border-blue-500 hover:bg-gray-900 rounded-[2rem] p-6 md:p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_15px_40px_-10px_rgba(59,130,246,0.3)] flex flex-col h-full overflow-hidden" 
                       data-category="<?php echo htmlspecialchars($category, ENT_QUOTES); ?>" 
                       data-title="<?php echo strtolower($tool['title'] . ' ' . $category); ?>">
                        
                        <div class="absolute top-0 right-0 w-32 h-32 bg-<?php echo $tool['color']; ?>-500/10 rounded-bl-full -mr-8 -mt-8 transition-transform duration-500 group-hover:scale-125 z-0"></div>
                        
                        <div class="w-14 h-14 bg-<?php echo $tool['color']; ?>-500/10 border border-<?php echo $tool['color']; ?>-500/20 rounded-2xl flex items-center justify-center mb-6 relative z-10 shadow-inner group-hover:bg-<?php echo $tool['color']; ?>-500/20 transition-colors duration-300">
                            <i class="fa-solid <?php echo $tool['icon']; ?> text-2xl text-<?php echo $tool['color']; ?>-400 group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                        
                        <h3 class="text-xl font-extrabold text-white mb-3 relative z-10 group-hover:text-blue-400 transition-colors">
                            <?php echo $tool['title']; ?>
                        </h3>
                        
                        <p class="text-gray-400 text-sm leading-relaxed flex-1 relative z-10 mb-8 group-hover:text-gray-300 transition-colors">
                            <?php echo $tool['desc']; ?>
                        </p>

                        <div class="flex items-center text-<?php echo $tool['color']; ?>-400 font-bold text-sm relative z-10 mt-auto group-hover:text-blue-400 transition-colors">
                            Launch Tool <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1.5 transition-transform"></i>
                        </div>
                    </a>

                <?php endforeach; ?>
            <?php endforeach; ?>

        </div>

        <div id="no-results" class="hidden text-center py-24">
            <div class="w-20 h-20 bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-6 border border-gray-800 shadow-inner">
                <i class="fa-solid fa-search text-3xl text-gray-500"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">No tools found</h3>
            <p class="text-gray-400 text-base">Try searching with different keywords like "Merge" or "Word".</p>
        </div>

    </div>
</main>

<script>
    // ==========================================
    // JS Logic: Typewriter, Tabs & Search Filtering
    // ==========================================
    
    // 1. Typewriter Effect Logic
    document.addEventListener("DOMContentLoaded", function() {
        const words = ["PDFs", "Documents", "Assignments", "Reports"];
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

            let typeSpeed = isDeleting ? 50 : 120;

            if (!isDeleting && charIndex === currentWord.length) {
                typeSpeed = 2000; // Pause at end of word
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

    // 2. Tab & Search Filter Engine
    const searchInput = document.getElementById('search-input');
    const toolCards = document.querySelectorAll('.tool-card');
    const noResults = document.getElementById('no-results');
    const tabBtns = document.querySelectorAll('.tab-btn');
    let currentCategory = 'All';

    function filterCategory(category) {
        currentCategory = category;
        
        // Update Tab Button Styles
        tabBtns.forEach(btn => {
            if (btn.innerText.trim() === category) {
                btn.className = 'tab-btn active shrink-0 px-6 py-3 rounded-full text-sm font-bold transition-all bg-accent-blue text-white shadow-lg shadow-blue-500/30 border border-blue-500';
            } else {
                btn.className = 'tab-btn shrink-0 px-6 py-3 rounded-full text-sm font-medium transition-all bg-dark-card/80 backdrop-blur-sm border border-gray-700 text-gray-400 hover:text-white hover:border-gray-500 hover:bg-gray-800';
            }
        });

        applyFilters();
    }

    searchInput.addEventListener('keyup', () => {
        applyFilters();
    });

    function applyFilters() {
        const query = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;
        let delayCounter = 0; // Reset animation stagger

        toolCards.forEach(card => {
            const title = card.getAttribute('data-title');
            const category = card.getAttribute('data-category');
            
            const matchesSearch = title.includes(query);
            const matchesCategory = (currentCategory === 'All' || category === currentCategory);

            if (matchesSearch && matchesCategory) {
                card.style.display = 'flex';
                visibleCount++;
                
                // Re-trigger animation beautifully
                card.style.animation = 'none';
                card.offsetHeight; /* trigger reflow */
                card.style.animation = null;
                card.style.animationDelay = `${(delayCounter % 12) * 0.05}s`;
                delayCounter++;
                
            } else {
                card.style.display = 'none';
            }
        });

        // Show/Hide No Results State
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }
</script>

<?php include '../includes/footer.php'; ?>