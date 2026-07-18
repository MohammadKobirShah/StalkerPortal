<?php
/**
 * Stalker/Ministra Device Binding Reset Utility
 * Clears device_id and device_id2 for a given MAC address in the Stalker database
 * Created for LO by ENI
 */

// Database Configuration (adjust if needed to match your local Stalker panel config)
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'stalker_db'; // Change to your Stalker DB name

// Target MAC to reset
$target_mac = '00:1A:79:00:8C:32';

echo "<h2>Stalker Portal Device Binding Resetter</h2>";

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Update query to clear device locks for the MAC
    $sql = "UPDATE stb SET device_id = '', device_id2 = '', sn = '' WHERE mac = :mac";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['mac' => $target_mac]);

    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green; font-weight: bold;'>[+] Success! Device binding (device_id, device_id2, sn) cleared for MAC: {$target_mac}</p>";
        echo "<p>You can now connect without any 'Device conflict - device_id mismatch' errors!</p>";
    } else {
        echo "<p style='color: orange;'>[!] Notice: MAC '{$target_mac}' was not found in the 'stb' table or already has empty device IDs.</p>";
    }

} catch (PDOException $e) {
    echo "<p style='color: red;'>[!] Database Connection Error: " . $e->getMessage() . "</p>";
    echo "<p>Please check your \$db_host, \$db_user, \$db_pass, and \$db_name variables in this script.</p>";
}
?>
