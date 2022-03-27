<?php
require_once __DIR__ . '/../store_manager.php';

function v_youtube_getChannelDir($channelId)
{
    $store = store_get_type_store('youtube');

    foreach ($store as $path => $info) {
        foreach (scandir($path) as $file) {
            if (str_starts_with($file, $channelId . '_')) {
                return $path . DIRECTORY_SEPARATOR . $file;
            }
        }
    }

    return null;
}

function v_youtube_getChannelStoreInfo($chd)
{
    global $storage;

    $path = dirname($chd);

    return $storage[$path] ?? null;
}

function v_youtube_getChannelInfo($chdir)
{
    foreach (scandir($chdir) as $file) {
        if (str_starts_with($file, 'NA_') && str_ends_with($file, '.info.json')) {
            return json_decode(file_get_contents($chdir . DIRECTORY_SEPARATOR . $file), true);
        }
    }
    return null;
}

function v_youtube_getChannelImageBin($chdir, $chid = null)
{
    foreach (scandir($chdir) as $file) {
        if (str_starts_with($file, 'NA_') && str_ends_with($file, ($chid ?? '') . '.jpg')) {
            return file_get_contents($chdir . DIRECTORY_SEPARATOR . $file);
        }
    }
    return null;
}

function v_youtube_getChannelDirName($chdir)
{
    return basename($chdir);
}

function v_youtube_removeUnusedVideoInfoData($data)
{
    $toret = array(
        'release_date' => $data['release_date'] ?? null,
        'upload_date' => $data['upload_date'] ?? null,
        'title' => $data['title'] ?? null,
        'id' => $data['id'] ?? null,
    );

    return $toret;
}

function v_youtube_getChannelContentsJsonPaths($chdir)
{
    $toret = array();

    foreach (scandir($chdir, 1) as $file) {
        if (!str_starts_with($file, 'NA_') && str_ends_with($file, '.info.json')) {
            $toret[] = $file;
        }
    }

    return $toret;
}

function v_youtube_getChannelContents($chdir)
{
    $toret = array();

    foreach (v_youtube_getChannelContentsJsonPaths($chdir) as $file) {
        $toret += array(
            substr($file, 0, -10) => v_youtube_removeUnusedVideoInfoData(json_decode(file_get_contents($chdir . DIRECTORY_SEPARATOR . $file), true))
        );
    }

    return $toret;
}

function v_youtube_getVideoInfoFromFilePath($path)
{
    return v_youtube_removeUnusedVideoInfoData(json_decode(file_get_contents($path), true));
}

function v_youtube_getVideoInfo($chdir, $id)
{
    foreach (scandir($chdir) as $file) {
        if (str_ends_with($file, $id . '.info.json')) {
            return array(
                'vpref' => substr($file, 0, -10),
                'info' => v_youtube_getVideoInfoFromFilePath($chdir . DIRECTORY_SEPARATOR . $file)
            );
        }
    }
    return null;
}

function v_youtube_getVideoDescription($chdir, $vpref)
{
    if (file_exists($chdir . DIRECTORY_SEPARATOR . $vpref . '.description')) {
        return file_get_contents($chdir . DIRECTORY_SEPARATOR . $vpref . '.description');
    }
    return null;
}

function v_youtube_getVideoThumbBin($chdir, $vpref)
{
    if (file_exists($chdir . DIRECTORY_SEPARATOR . $vpref . '.webp')) {
        return file_get_contents($chdir . DIRECTORY_SEPARATOR . $vpref . '.webp');
    }
    return null;
}

function v_youtube_getSubtitles($chdir, $vidpref)
{
    $toret = array();

    foreach (scandir($chdir) as $file) {
        if (str_starts_with($file, $vidpref) && str_ends_with($file, '.vtt')) {
            $fdot = explode('.', $file);
            $lang = $fdot[count($fdot) - 2];
            $toret += array(
                $lang => $file
            );
        }
    }

    return $toret;
}

function v_youtube_getSubtitle($chdir, $vidpref, $lang)
{
    if (file_exists($chdir . DIRECTORY_SEPARATOR . $vidpref . '.' . $lang . '.vtt')) {
        return file_get_contents($chdir . DIRECTORY_SEPARATOR . $vidpref . '.' . $lang . '.vtt');
    }

    return null;
}

function v_youtube_getChannelsDirs()
{
    $store = store_get_type_store('youtube');

    $toret = array();

    foreach ($store as $path => $info) {
        foreach (array_diff(scandir($path), array('.', '..')) as $file) {
            $dir = $path . DIRECTORY_SEPARATOR . $file;
            if (is_dir($dir)) {
                $toret[] = $dir;
            }
        }
    }

    return $toret;
}


function v_youtube_getChannels()
{
    $toret = array();

    foreach (v_youtube_getChannelsDirs() as $dir) {
        $ci = v_youtube_getChannelInfo($dir);
        if ($ci != null && $ci['uploader_id'] != null)
            array_push($toret, $ci);
    }

    return $toret;
}

require __DIR__ . '/../../_scr_override.php';
