<?php
require_once '../../_internal/v/youtube.php';

if (!isset($_GET['channel']))
    die('No channel specified');

$chd = v_youtube_getChannelDir($_GET['channel']);
if ($chd === null) {
    http_response_code(404);
    die('User image not found');
}
$ui = v_youtube_getChannelImageBin($chd, $_GET['channel']);

header('Content-Type: image/webp');

print($ui);
