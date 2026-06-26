<?php
header('Content-Type: audio/x-mpegurl');
header('Content-Disposition: inline; filename="jitendraunatti.m3u"');
include 'jitendraunatti.php';
global $SCARLET_WITCH;
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$currentPath = dirname($_SERVER['PHP_SELF']);
$baseUrl = $protocol . $host . rtrim($currentPath, '/\\') . "/";
if (file_exists($DARK_SIDE . "/login.jitendraunatti")) {
    $channels = json_decode(json_fetcher(), true);
} else {
    exit("#EXTM3U\n#EXTINF:-1,Cache Missing - Please Refresh Dashboard");
}
echo "#EXTM3U\n";
foreach ($SCARLET_WITCH['addon_service'] as $addone) {
    if (isset($addone)) {
        echo file_get_contents($addone);
    }
}
/*
        ⚠️ NOTICE TO USERS & DEVELOPERS

        This source code is provided FREE of cost.

        If you obtained this code from any paid source or third-party,
        you have been misled.

        👉 Official source:
        https://github.com/Jitendraunatti/Stalker-Portal

        Please support original work and do not promote reselling.

        — Jitendra Kumar
        */
foreach ($channels as $channel) {
    $name  = $channel['Name'];
    $id    = $channel['playback_url'];
    $logo  = $channel['logo'];
    $genre = $channel['genre'];
    $fullStreamUrl = $baseUrl . "live.php?id=" . $id;
    echo "#EXTINF:-1 tvg-id=\"$id\" tvg-logo=\"$logo\" group-title=\"$genre\",$name\n";
    echo $fullStreamUrl . "\n";
}
