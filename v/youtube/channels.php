<?php
require_once '../../_internal/v/youtube.php';

$chs = v_youtube_getChannels();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube - Archives</title>
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">YouTube Archive</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h1>YouTube</h1>
            </div>
        </div>
        <div class="row mt-3">
            <?php foreach ($chs as $ch) : ?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2 p-2">
                    <div class="card">
                        <img src="userimage.php?channel=<?= $ch['uploader_id'] ?>" class="card-img-top" alt="User image">
                        <div class="card-body">
                            <h5 class="card-title"><a href="channel.php?channel=<?= $ch['uploader_id'] ?>"><?= $ch['uploader'] ?></a></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>