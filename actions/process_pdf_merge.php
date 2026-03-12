<?php
session_start();

$autoload_path = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($autoload_path)) {
    die("Composer autoload not found.");
}

require_once $autoload_path;
use setasign\Fpdi\Fpdi;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdfs'])) {
    
    $temp_dir = __DIR__ . '/../uploads/temp_pdf/';
    if (!is_dir($temp_dir)) { mkdir($temp_dir, 0777, true); }

    $uploaded_files = [];
    $total_files = count($_FILES['pdfs']['name']);

    if ($total_files < 2) {
        die("<script>alert('Please upload at least 2 PDF files.'); window.location.href='../pdf_tools/merge_pdf.php';</script>");
    }

    for ($i = 0; $i < $total_files; $i++) {
        if ($_FILES['pdfs']['error'][$i] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['pdfs']['tmp_name'][$i];
            $file_ext = strtolower(pathinfo($_FILES['pdfs']['name'][$i], PATHINFO_EXTENSION));
            
            if ($file_ext === 'pdf') {
                $safe_name = $temp_dir . uniqid('merge_') . '_' . $i . '.pdf';
                if (move_uploaded_file($file_tmp, $safe_name)) {
                    $uploaded_files[] = $safe_name;
                }
            }
        }
    }

    try {
        $pdf = new Fpdi();
        foreach ($uploaded_files as $file) {
            $pageCount = $pdf->setSourceFile($file);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $templateId = $pdf->importPage($pageNo);
                $size = $pdf->getTemplateSize($templateId);
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $pdf->useTemplate($templateId);
            }
        }

        foreach ($uploaded_files as $file) { @unlink($file); }
        $final_filename = 'DevHub_Merged_' . date('Y-m-d_H-i-s') . '.pdf';
        $pdf->Output('D', $final_filename);
        exit();

    } catch (Exception $e) {
        // CLEANUP & SHOW PROFESSIONAL ERROR UI
        foreach ($uploaded_files as $file) { @unlink($file); }
        $error_msg = $e->getMessage();
        
        $user_friendly_msg = "An unexpected error occurred during merging.";
        if (strpos($error_msg, 'compression technique') !== false) {
            $user_friendly_msg = "One of your uploaded PDFs uses an advanced compression technique (PDF v1.5+) that is not supported by our free parser. <br><br><b>Quick Fix:</b> Open your PDF in Chrome, click 'Print', and select 'Save as PDF' to create a standard, supported version.";
        }

        // Show Professional Error Screen
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='utf-8'>
            <title>Merge Error - DevHub</title>
            <script src='https://cdn.tailwindcss.com'></script>
            <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' rel='stylesheet'/>
            <body class='bg-[#0a0f1c] min-h-screen flex items-center justify-center p-4 font-sans'>
                <div class='bg-[#1e293b] border border-red-500/30 rounded-3xl p-8 max-w-lg text-center shadow-2xl'>
                    <div class='w-20 h-20 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-6'>
                        <i class='fa-solid fa-file-circle-xmark text-4xl text-red-500'></i>
                    </div>
                    <h2 class='text-2xl font-bold text-white mb-4'>Merge Failed</h2>
                    <p class='text-gray-400 text-sm mb-8 leading-relaxed'>{$user_friendly_msg}</p>
                    <a href='../pdf_tools/merge_pdf.php' class='bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-xl transition-all'>
                        <i class='fa-solid fa-arrow-left mr-2'></i> Try Again
                    </a>
                </div>
            </body>
        </html>
        ";
        exit();
    }
} else {
    header("Location: ../pdf_tools/merge_pdf.php");
    exit();
}
?>