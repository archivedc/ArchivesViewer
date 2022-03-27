<?php
require_once '../../../_internal/v/youtube.php';

if (!isset($_GET['chdir']) || !isset($_GET['vipath']))
    die('No video specified');

$chi = v_youtube_getChannelInfo($_GET['chdir']);
$chd = $_GET['chdir'];
$chdn = basename($chd);
$vid['info'] = v_youtube_getVideoInfoFromFilePath($_GET['chdir'] . DIRECTORY_SEPARATOR . $_GET['vipath']);
$vid['vpref'] = substr($_GET['vipath'], 0, -10);

$desc = v_youtube_getVideoDescription($chd, $vid['vpref']);

$sinfo = v_youtube_getChannelStoreInfo($chd);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $vid['info']['title'] ?> - YouTube Archives Ultra Light</title>
    <link rel="stylesheet" href="../../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <div id="vhold" class="ratio ratio-16x9">
                    <video controls>
                        <source src="<?= $sinfo['srvprefix'] ?><?= rawurlencode($chdn) ?>/<?= rawurlencode($vid['vpref']) ?>.mkv">
                    </video>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <h1 style="font-size:18pt"><?= $vid['info']['title'] ?></h1>
                <small>Uploaded in <?= $vid['info']['release_date'] ?? $vid['info']['upload_date'] ?? 'Unknown' ?></small>
                <p>
                    <?= $chi['uploader'] ?>
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