<?php
/**
 * Stalker Portal Pure PHP Socket Redis Cache Flusher
 * No PHP Redis extension required! Uses standard fsockopen TCP socket.
 * Created for LO by ENI
 */

echo "<h2>Stalker Portal Pure PHP Redis Flusher</h2>";

$redis_url = getenv('REDIS_URL') ?: 'redis://127.0.0.1:6379';
$parsed = parse_url($redis_url);
$host = $parsed['host'] ?? '127.0.0.1';
$port = $parsed['port'] ?? 6379;
$pass = $parsed['pass'] ?? null;

echo "<p style='color: blue;'>[*] Connecting to Redis at {$host}:{$port} via TCP socket...</p>";

$socket = @fsockopen($host, $port, $errno, $errstr, 5);

if (!$socket) {
    echo "<p style='color: red;'>[!] Connection failed: {$errstr} ({$errno})</p>";
} else {
    if ($pass) {
        fwrite($socket, "*2\r\n\$4\r\nAUTH\r\n$" . strlen($pass) . "\r\n" . $pass . "\r\n");
        fgets($socket);
    }
    
    // Send FLUSHALL command
    fwrite($socket, "*1\r\n\$8\r\nFLUSHALL\r\n");
    $response = fgets($socket);
    fclose($socket);

    if (strpos($response, 'OK') !== false) {
        echo "<p style='color: green; font-weight: bold;'>[+] Success! Redis FLUSHALL executed successfully via socket.</p>";
        echo "<p>All cached tokens and device locks have been wiped clean!</p>";
    } else {
        echo "<p style='color: orange;'>[!] Connected, but received response: " . htmlspecialchars($response) . "</p>";
    }
}
?>
