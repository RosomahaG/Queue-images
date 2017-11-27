<?php

include '../loader.php';

if (is_cli()) {
    while (true) {
        $file_list = scandir('../prepared_files');
        foreach ($file_list as $file) {
            if ($file != '.' && $file != '..' && $file != '.gitkeep') {
                $file_path = ROOT . '/prepared_files/' . $file;
                $storage_path = ROOT . '/files/' . $file;
                $thumb_path = ROOT . '/thumbs/' . $file;
                if (!file_exists($thumb_path)) {
                    $tmp = explode('.', $file_path);
                    makeThumb($file_path, $thumb_path, $storage_path, array_pop($tmp));
                    chmod($thumb_path, 0777);
                    echo "Handled: ".$file_path . "\n";
                    image_save($file_path, $thumb_path);
                }
            }
        }
        sleep(10);
    }
}
