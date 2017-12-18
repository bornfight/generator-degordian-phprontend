<?php

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Degordian (http://www.degordian.com)">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= ucfirst(PROJECT_NAME) ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= buStatic('dist/style.css') ?>">
    <script defer src="<?= buStatic('dist/vendor.js') ?>"></script>
    <script defer src="<?= buStatic('dist/bundle.js') ?>"></script>
    <?php wp_head(); ?>
</head>
<body>
