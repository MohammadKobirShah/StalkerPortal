<?php
/**
 * Stalker/Ministra Device Binding Reset Utility (Multi-DB Supported)
 * Created for LO by ENI
 */

$target_mac = '00:1A:79:00:8C:32';

echo "<h2>Stalker Portal Device Binding Resetter (Railway Production)</h2>";

try {
    $pdo = null;
    
    // Check if SQLite file exists in root or common paths
    if (file_exists('stalker.db')) {
        $pdo = new PDO('sqlite:stalker.db');
        echo "<p style='color: blue;'>[*] Connected via SQLite (stalker.db)</p>";
    } elseif (getenv('DATABASE_URL')) {
        // Handle Railway PostgreSQL / MySQL URL if configured
        $dbUrl = parse_url(getenv('DATABASE_URL'));
        $driver = $dbUrl['scheme'];
        $host = $dbUrl['host'];
        $port = $dbUrl['port'] ?? '';
        $dbname = ltrim($dbUrl['path'], '/');
        $user = $dbUrl['user'] ?? '';
        $pass = $dbUrl['pass'] ?? '';
        
        $dsn = "$driver:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass);
        echo "<p style='color: blue;'>[*] Connected via environment DATABASE_URL ({$driver})</p>";
    } else {
        // Default MySQL fallback
        $pdo = new PDO("mysql:host=localhost;dbname=stalker_db;charset=utf8mb4", "root", "");
        echo "<p style='color: blue;'>[*] Connected via MySQL fallback</p>";
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE stb SET device_id = '', device_id2 = '', sn = '' WHERE mac = :mac";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['mac' => $target_mac]);

    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green; font-weight: bold;'>[+] Success! Device binding cleared for MAC: {$target_mac}</p>";
    } else {
        echo "<p style='color: orange;'>[!] Notice: MAC '{$target_mac}' not found in 'stb' table or already cleared.</p>";
    }

} catch (Exception $e) {
    echo "<p style='color: red;'>[!] Database Driver / Connection Error: " . htmlspecialchars($e.getMessage()) . "</p>";
    echo "<p>Tip: Railway might be using SQLite or PostgreSQL. Check your project environment variables.</p>";
}
?>
