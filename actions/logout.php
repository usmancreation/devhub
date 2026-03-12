<?php
session_start();

// User ka session destroy karein taake wo logout ho jaye
session_unset();
session_destroy();

// Logout hone ke baad user ko dobara Home Page par bhej dein
header("Location: ../index.php");
exit();
?>