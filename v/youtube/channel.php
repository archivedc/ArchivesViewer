<?php

require_once '../../_internal/v/youtube.php';

if (!isset($_GET['channel']))
    die('No channel specified');

$chd = v_youtube_getChannelDir($_GET['channel']);
$chi = v_youtube_getChannelInfo($chd);

$contents = v_youtube_getChannelContents($chd);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $chi['uploader'] ?> - Archives</title>
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="channels.php">YouTube Archive</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $chi['uploader'] ?></li>
        </ol>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h1>
                    <img src="userimage.php?channel=<?= $_GET['channel'] ?>" class="rounded-circle" height="65px" alt="User image">
                    <?= $chi['uploader'] ?>
                </h1>
            </div>
        </div>
        <div class="row mt-3">
            <?php foreach ($contents as $dir => $info) : ?>
                <div class="col-6 col-md-4 col-xl-3 p-2">
                    <div class="card">
                        <img src="thumb.php?channel=<?= $_GET['channel'] ?>&id=<?= $info['id'] ?>" class="card-img-top" alt="Thumbnail">
                        <div class="card-body">
                            <h5 class="card-title"><a href="watch.php?channel=<?= $_GET['channel'] ?>&id=<?= $info['id'] ?>"><?= $info['title'] ?></a></h5>
                            <p class="card-text"><small class="text-muted"><?= $info['release_date'] ?? $info['upload_date'] ?? '' ?></small></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>