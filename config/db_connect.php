<?php
// Database Configuration
$host = "localhost";
$dbname = "devhub_db"; // Apne database ka naam yahan likhein
$username = "root";    // XAMPP/WAMP default username
$password = "";        // XAMPP/WAMP default password (usually empty)

try {
    // Data Source Name (DSN) setup
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    
    // PDO instance create karna
    $pdo = new PDO($dsn, $username, $password);
    
    // Professional Error Handling Attributes
    // ERRMODE_EXCEPTION: Database ka koi bhi masla ho toh ye error throw karega jise hum catch kar sakte hain
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // FETCH_ASSOC: Data ko associative array ki form mein layega (e.g. $row['email'])
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Agar future mein prepared statements ko strictly enforce karna ho:
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    // Agar connection fail ho jaye toh user ko error dikhaye ga (Production mein ise log kiya jata hai)
    die("<div style='background:#ff4d4f; color:white; padding:15px; text-align:center; font-family:sans-serif;'>
            <strong>Database Connection Failed:</strong> " . $e->getMessage() . "
         </div>");
}
?>