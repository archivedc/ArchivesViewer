<?php
require_once '../../../_internal/v/youtube.php';

$chds = v_youtube_getChannelsDirs();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Channel Directories - YouTube Archives Ultra Light</title>
</head>

<body>
    <ul>
        <?php foreach ($chds as $chd) : ?>
            <li><a href="channel.php?chdir=<?= urlencode($chd) ?>"><?= basename($chd) ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>