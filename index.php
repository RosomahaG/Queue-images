<?php
/** @var string $styles */
/** @var string $scripts */
/** @var string $title */

include 'loader.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <?= $styles ?>
</head>
<body>
<div class="container">
    <?php include 'partials/header.php'; ?>
    <?php include 'content.php'; ?>
</div>
<?= $scripts ?>
</body>
</html>