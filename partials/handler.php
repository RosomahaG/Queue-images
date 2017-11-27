<?php

include '../loader.php';

$files = [];

foreach ($_FILES['images']['tmp_name'] as $k => $v) {
    $files [] = [
        'name' => $_FILES['images']["name"][$k],
        'type' => $_FILES['images']["type"][$k],
        'tmp_name' => $_FILES['images']["tmp_name"][$k],
        'error' => $_FILES['images']["error"][$k],
        'size' => $_FILES['images']["size"][$k],
    ];
}

foreach ($files as $file) {
    $file_path = ROOT . '/prepared_files/' . basename($file['name']);
    $tmp = move_uploaded_file($file['tmp_name'], $file_path);
    chmod($file_path, 0777);
}