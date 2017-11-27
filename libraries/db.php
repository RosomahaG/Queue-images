<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'queue');

if (mysqli_connect_errno()) {
    printf("Ошибка соединения БД: %s\n", mysqli_connect_error());
    exit();
}