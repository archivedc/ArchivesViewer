<?php

require_once '../../_internal/v/youtube.php';

if (!isset($_GET['channel']))
    die('No channel specified');

$chd = v_youtube_getChannelDir($_GET['channel']);
$chi = v_youtube_getChannelInfo($chd);
$chdn = v_youtube_getChannelDirName($chd);

$vid = v_youtube_getVideoInfo($chd, $_GET['id']);

$desc = v_youtube_getVideoDescription($chd, $vid['vpref']);
$subs = v_youtube_getSubtitles($chd, $vid['vpref']);

$sinfo = v_youtube_getChannelStoreInfo($chd);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $vid['info']['title'] ?> - <?= $chi['uploader'] ?> - Archives</title>
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="channels.php">YouTube Archive</a></li>
            <li class="breadcrumb-item"><a href="channel.php?channel=<?= $_GET['channel'] ?>"><?= $chi['uploader'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $vid['info']['title'] ?></li>
        </ol>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <div id="vhold" class="ratio ratio-16x9">
                    <video controls poster="thumb.php?channel=<?= $_GET['channel'] ?>&id=<?= $_GET['id'] ?>">
                        <source src="<?= $sinfo['srvprefix'] ?><?= str_replace('+', '%20', urlencode($chdn)) ?>/<?= str_replace('+', '%20', urlencode($vid['vpref'])) ?>.mkv">
                        <?php foreach ($subs as $lang => $sub) : ?>
                            <track kind="subtitles" src="subtitle.php?channel=<?= $_GET['channel'] ?>&id=<?= $_GET['id'] ?>&lang=<?= $lang ?>" srclang="<?= $lang ?>" label="<?= $lang ?>">
                        <?php endforeach; ?>
                    </video>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <h1 style="font-size:18pt"><?= $vid['info']['title'] ?></h1>
                <small>Uploaded in <?= $vid['info']['release_date'] ?? $vid['info']['upload_date'] ?? 'Unknown' ?></small>
                <p>
                    <img src="userimage.php?channel=<?= $_GET['channel'] ?>" class="rounded-circle" height="40px" alt="User image">
                    <a href="channel.php?channel=<?= $_GET['channel'] ?>"><?= $chi['uploader'] ?></a>
                </p>
                <hr />
                <div id="desc">
                    <pre>
<?= $desc ?>
                    </pre>
                </div>
            </div>
        </div>
    </div>
</body>

</html>