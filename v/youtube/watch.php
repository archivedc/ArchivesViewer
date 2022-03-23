<?php

require_once '../../_internal/v/youtube.php';

if (!isset($_GET['channel']))
    die('No channel specified');

$chd = v_youtube_getChannelDir($_GET['channel']);
$chi = v_youtube_getChannelInfo($chd);
$chdn = v_youtube_getChannelDirName($chd);

$vid = v_youtube_getVideoInfo($chd, $_GET['id']);

$desc = v_youtube_getVideoDescription($chd, $vid['vpref']);

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
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <div id="vhold" class="ratio ratio-16x9">
                    <video src="<?= $sinfo['srvprefix'] ?><?= str_replace('+', '%20', urlencode($chdn)) ?>/<?= str_replace('+', '%20', urlencode($vid['vpref'])) ?>.mkv" controls poster="thumb.php?channel=<?= $_GET['channel'] ?>&id=<?= $_GET['id'] ?>"></video>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
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