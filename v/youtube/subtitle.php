<?php
require_once '../../_internal/v/youtube.php';

if (!isset($_GET['channel']))
    die('No channel specified');

$chd = v_youtube_getChannelDir($_GET['channel']);
$chi = v_youtube_getChannelInfo($chd);

$vid = v_youtube_getVideoInfo($chd, $_GET['id']);
$sub = v_youtube_getSubtitle($chd, $vid['vpref'], $_GET['lang']);

header('Content-Type: text/vtt');

print($sub);
