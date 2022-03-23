<?php
require_once __DIR__ . '/../_config.php';

function store_get_type_store($type)
{
    global $storage;

    $toret = array();

    foreach ($storage as $path => $info) {
        if ($info['type'] == $type)
            $toret += array($path => $info);
    }

    return $toret;
}
