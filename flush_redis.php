<?php
/**
 * Stalker Portal Redis Cache & Session Flusher
 * Uses Railway Redis URL to clear cached tokens and device binding conflicts instantly
 * Created for LO by ENI
 */

echo "<h2>Stalker Portal Redis Cache Flusher</h2>";

// Get Redis URL from Railway environment variable
$redis_url = getenv('REDIS_URL');

if (!$redis_url) {
    // Fallback if passed via standard config or template
    $redis_url = 'redis://localhost:6379';
}

echo "<p style='color: blue;'>[*] Connecting to Redis...</p>";

try {
    // Parse Redis URL (redis://user:pass@host:port)
    $parsed = parse_url($redis_url);
    $host = $parsed['host'] ?? '127.0.0.1';
    $port = $parsed['port'] ?? 6379;
    $pass = $parsed['pass'] ?? null;

    // Use PhpRedis extension if available
    if (class_exists('Redis')) {
        $redis = new Redis();
        $redis->connect($host, $port);
        if ($pass) {
            $redis->auth($pass);
        }
        
        // Flush all cached tokens and device states
        $redis->flushAll();
        echo "<p style='color: green; font-weight: bold;'>[+] Success! Redis cache successfully flushed (FLUSHALL executed).</p>";
        echo "<p>All cached Stalker tokens and device conflict locks have been cleared!</p>";
    } else {
        echo "<p style='color: red;'>[!] PHP Redis extension is not installed or enabled in this environment.</p>";
    }

} catch (Exception $e) {
    echo "<p style='color: red;'>[!] Redis Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

path: flush_redis.php
