<?php

require_once '../../../_internal/v/youtube.php';

if (!isset($_GET['chdir']))
    die('No channel specified');

$chi = v_youtube_getChannelInfo($_GET['chdir']);

if ($chi === null)
    die('Not a channel directory');

$contents = v_youtube_getChannelContentsJsonPaths($_GET['chdir']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $chi['uploader'] ?> - YouTube Archives Ultra Light</title>
</head>

<body>

    <ul>
        <?php foreach ($contents as $c) : ?>
            <li><a href="watch.php?chdir=<?= urlencode($_GET['chdir']) ?>&vipath=<?= urlencode($c) ?>"><?= substr($c, 0, -10) ?></a></li>
        <?php endforeach; ?>
    </ul>

</body>

</html>