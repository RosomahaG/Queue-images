<?php

function dd()
{
    foreach (func_get_args() as $arg) {
        echo '<pre>';
        var_dump($arg);
        echo '</pre><br>';
    }

    exit;
}

function dump()
{
    foreach (func_get_args() as $arg) {
        echo '<pre>';
        var_dump($arg);
        echo '</pre><br>';
    }
}

function makeThumb($source_image, $destination_thumbnail, $storage_path, $ext)
{
    $source_path = $source_image;
    /* read the source image */
    if ($ext == 'jpg' || $ext == 'jpeg') {
        $source_image = imagecreatefromjpeg($source_image);
    } elseif ($ext == 'png') {
        $source_image = imagecreatefrompng($source_image);
    } else {
        exit('Bad image extension!');
    }

    $width = imagesx($source_image);
    $height = imagesy($source_image);

    $desired_width = 100;
    $desired_height = 100;

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

    /* create the physical thumbnail image to its destination */
    if ($ext == 'jpg' || $ext == 'jpeg') {
        imagepng($virtual_image, $destination_thumbnail);
    } elseif ($ext == 'png') {
        imagejpeg($virtual_image, $destination_thumbnail);
    } else {
        exit('Bad image extension!');
    }
    
    rename($source_path, $storage_path);
}

function is_cli()
{
    if (defined('STDIN')) {
        return true;
    }
    if (php_sapi_name() === 'cli') {
        return true;
    }
    if (array_key_exists('SHELL', $_ENV)) {
        return true;
    }
    if (empty($_SERVER['REMOTE_ADDR']) and !isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) > 0) {
        return true;
    }
    if (!array_key_exists('REQUEST_METHOD', $_SERVER)) {
        return true;
    }
    return false;
}

function image_save($file_path, $thumb_path)
{
    global $mysqli;
    $mysqli->query("INSERT INTO images (`file_path`, `thumb_path`, `title`, `description`) 
                    VALUES (
                    '" . $mysqli->real_escape_string($file_path) . "',
                    '" . $mysqli->real_escape_string($thumb_path) . "',
                    '" . $mysqli->real_escape_string(basename($file_path)) . "',
                    '');");
}

function image_delete($id)
{
    global $mysqli;
    return $mysqli->query("DELETE FROM images WHERE id = " . $id);
}

function image_update($id, $title, $description)
{
    global $mysqli;
    $sql = [];
    if (!empty($title)) {
        $sql [] = "`title` = '" . $title . "'";
    }
    if (!empty($description)) {
        $sql [] = "`description` = '" . $description . "'";
    }
    if (!empty($sql)) {
        return $mysqli->query("UPDATE images SET " . implode(',', $sql) . " WHERE `id` = " . $id . ";");
    } else {
        return false;
    }
}

function image_list()
{
    global $mysqli;
    $res = $mysqli->query("SELECT * FROM images ORDER BY id ASC;");
    $result = [];
    while ($row = $res->fetch_assoc()) {
        $result [] = $row;
    }

    return $result;
}

