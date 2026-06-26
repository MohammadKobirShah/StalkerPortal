<?php
require_once 'jitendraunatti.php';
global $SCARLET_WITCH, $MJ;
$ROLEX = [
    'User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3',
    'Connection: Keep-Alive',
];
if (@$_REQUEST['id']) {
    $ANTMAN = json_decode(doctor_strange($_REQUEST['id']), true);
    if ($ANTMAN['JITENDRAUNATTI']['Statuscode'] !== 200) {
        if (strpos($ANTMAN['JITENDRAUNATTI']['data'], 'Authorization failed') !== false) {
            @unlink($DARK_SIDE . "/login.jitendraunatti");
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
    }
    $stream = $ANTMAN['JITENDRAUNATTI']['cmd'];
    if (strpos($stream, "http") !== false) {
        if ($MJ['Proxy'] == "DIRECT") {
            header("Location: " .  $stream);
            exit();
        }
        $DOCTOR_STRANGE = jitendraunatti($stream, $ROLEX, "GET", null, 0, 1, 0, 0, true);
        $CHRISTINE =  $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"];
        $status_code = (int)($DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"]);
        if ($status_code == "301" || $status_code == "302") {
            $VISION = dirname(explode('?', $stream)[0]) . "/";
            $WALTER = 'live.php?token=' . base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d"))  . '&jitendraunatti=' .  scarlet_witch("encrypt", $VISION) .  '&wanda=' . scarlet_witch("encrypt", $stream) . "\n";
            header("Location: " .  $WALTER);
            exit();
        }
        if ((strpos($stream, "http") !== false) && $status_code == "200") {
            $VISION = dirname(explode('?', $stream)[0]) . "/";
            header("Content-Type: application/vnd.apple.mpegurl");
            $CASSIE = '';
            $JPD = explode("\n", $DOCTOR_STRANGE['JITENDRAUNATTI']['data']);
            foreach ($JPD as $WANDA) {
                if (empty($WANDA)) continue;
                if (strpos($WANDA, 'URI="') !== false) {
                    $CASSIE .= str_replace('URI="', 'URI="live.php?token=' . base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d")) .  '&wanda=' .  scarlet_witch("encrypt", $VISION), $WANDA) . "\n";
                } elseif (strpos($WANDA, '.m3u8') !== false && strpos($WANDA, '#') === false) {
                    $CASSIE .= 'live.php?token=' . base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d")) . '&jitendraunatti=' .  scarlet_witch("encrypt", $VISION) . '&wanda=' . scarlet_witch("encrypt", $VISION . $WANDA) . "\n";
                } elseif (strpos($WANDA, '.ts') !== false && strpos($WANDA, '#') === false) {
                    $CASSIE .= 'live.php?token=' . base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d")) . '&jitendraunatti=' .  scarlet_witch("encrypt", $VISION) . '&cassie=' . scarlet_witch("encrypt", $VISION . $WANDA) . "\n";
                } else {
                    $CASSIE .= $WANDA . "\n";
                }
            }
            exit(trim(str_replace(["#EXTM3U"], ["#EXTM3U\n#DEVELOPED_BY_{$SCARLET_WITCH['JITENDRA_UNIVERSE']["x-developed-by"]}\n#AUTHOR-{$SCARLET_WITCH['JITENDRA_UNIVERSE']["token"]}"], $CASSIE)));
        } else {
            header("Location: " .  $stream);
            exit;
        }
    } else {
        header("Location: " . $SCARLET_WITCH['meta_data']["fallback_video"]);
        exit;
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
} elseif (!empty($_REQUEST['wanda']) && $_REQUEST['token'] == base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d"))) {
    $DOCTOR_STRANGE = jitendraunatti(scarlet_witch("decrypt", $_REQUEST['wanda']), $ROLEX, "GET", null, 0, 1, 0, 0, true);
    $CHRISTINE =  $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"];
    $status_code = (int)($DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"]);
    $VISION = scarlet_witch("decrypt", $_REQUEST['jitendraunatti']);
    if ((strpos($VISION, "http") !== false) && $status_code == "200") {
        header("Content-Type: application/vnd.apple.mpegurl");
        $CASSIE = '';
        $JPD = explode("\n", $DOCTOR_STRANGE['JITENDRAUNATTI']['data']);
        foreach ($JPD as $WANDA) {
            if (empty($WANDA)) continue;
            if (strpos($WANDA, '.ts') !== false && strpos($WANDA, '#') === false) {
                $CASSIE .= 'live.php?token=' . base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d")) . '&cassie=' . scarlet_witch("encrypt", $VISION . $WANDA) . "\n";
            } else {
                $CASSIE .= $WANDA . "\n";
            }
        }
        exit(trim(str_replace(["#EXTM3U"], ["#EXTM3U\n#DEVELOPED_BY_{$SCARLET_WITCH['JITENDRA_UNIVERSE']["x-developed-by"]}\n#AUTHOR-{$SCARLET_WITCH['JITENDRA_UNIVERSE']["token"]}"], $CASSIE)));
    }
} elseif (!empty($_REQUEST['cassie']) && $_REQUEST['token'] == base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d"))) {
    header("Content-Type: video/mp2t");
    $DOCTOR_STRANGE = jitendraunatti(scarlet_witch("decrypt", $_REQUEST['cassie']), $ROLEX, "GET", null, 0, 1, 0, 0, true);
    echo $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"];
} else {
    header("Location: " . $SCARLET_WITCH['meta_data']["fallback_video"]);
    exit;
}
