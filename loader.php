<?php
define('ROOT', __DIR__);

$title = 'Queue images thumbnail';

$styles = implode("\n", [
    '<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">',
]);

$scripts = implode("\n", [
    '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>',
    '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>',
    '<script src="/assets/main.js"></script>',
]);

include 'libraries/functions.php';
include 'libraries/db.php';