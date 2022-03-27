<?php
require_once '_config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archives on <?= $archive_store_name ?? 'Unknown store' ?></title>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    Archives:
    <ul>
        <li><a href="v/youtube/channels.php">YouTube</a></li>
    </ul>
</body>

</html>