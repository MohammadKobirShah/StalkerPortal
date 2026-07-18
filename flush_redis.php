<?php
/**
 * Bulletproof Pure PHP Socket Redis Cache Flusher for Railway
 * Checks REDIS_URL, REDISHOST, REDIS_HOST environment variables
 * Created for LO by ENI
 */

echo "<h2>Stalker Portal Bulletproof Redis Flusher</h2>";

$host = '127.0.0.1';
$port = 6379;
$pass = null;

// Check Railway environment variables
if (getenv('REDIS_URL')) {
    $parsed = parse_url(getenv('REDIS_URL'));
    $host = $parsed['host'] ?? $host;
    $port = $parsed['port'] ?? $port;
    $pass = $parsed['pass'] ?? null;
} elseif (getenv('REDISHOST')) {
    $host = getenv('REDISHOST');
    $port = getenv('REDISPORT') ?? 6379;
    $pass = getenv('REDISPASSWORD') ?? null;
} elseif (getenv('REDIS_HOST')) {
    $host = getenv('REDIS_HOST');
    $port = getenv('REDIS_PORT') ?? 6379;
    $pass = getenv('REDIS_PASSWORD') ?? null;
}

echo "<p style='color: blue;'>[*] Connecting to Redis at <b>{$host}:{$port}</b>...</p>";

$socket = @fsockopen($host, $port, $errno, $errstr, 5);

if (!$socket) {
    echo "<p style='color: red;'>[!] Connection failed: " . htmlspecialchars($errstr) . " ({$errno})</p>";
    echo "<p>Tip: Make sure Redis is attached to your Railway service and environment variables are linked.</p>";
} else {
    if ($pass) {
        fwrite($socket, "*2\r\n\$4\r\nAUTH\r\n$" . strlen($pass) . "\r\n" . $pass . "\r\n");
        fgets($socket);
    }
    
    fwrite($socket, "*1\r\n\$8\r\nFLUSHALL\r\n");
    $response = fgets($socket);
    fclose($socket);

    if (strpos($response, 'OK') !== false || strpos($response, '+OK') !== false) {
        echo "<p style='color: green; font-weight: bold;'>[+] Success! Redis FLUSHALL executed successfully.</p>";
        echo "<p>All cached Stalker tokens and device locks have been wiped clean!</p>";
    } else {
        echo "<p style='color: orange;'>[!] Connected, but received response: " . htmlspecialchars($response) . "</p>";
    }
}
?>
