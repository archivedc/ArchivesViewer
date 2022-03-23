<?php
require_once '../../_internal/v/youtube.php';

if (!isset($_GET['channel']))
    die('No channel specified');

$chd = v_youtube_getChannelDir($_GET['channel']);
$chi = v_youtube_getChannelInfo($chd);

$vid = v_youtube_getVideoInfo($chd, $_GET['id']);
$thumb = v_youtube_getVideoThumbBin($chd, $vid['vpref']);

header('Content-Type: image/webp');

print($thumb);
