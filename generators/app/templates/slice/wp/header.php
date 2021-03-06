<?php

?>
<!DOCTYPE html>
<head>
    <?php
    //IMPORTANT NOTE! Order of tags should be as shown in this file
    // 1. META TAGS
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Degordian (http://www.degordian.com)">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    // 2. FAVICONS
    ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= buStatic('favicon/apple-touch-icon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= buStatic('favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= buStatic('favicon/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?= buStatic('favicon/manifest.json'); ?>">
    <link rel="mask-icon" href="<?= buStatic('favicon/safari-pinned-tab.svg'); ?>" color="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <meta name="msapplication-navbutton-color" content="#ffffff">
    <meta name="apple-mobile-web-app-status-bar-style" content="#ffffff">
    <?php
    // 3. TITLE
    ?>
    <title><?= ucfirst(PROJECT_NAME) ?></title>
    <?php
    // 4. CRITICAL CSS
    // 5. ALL CSS
    ?>
    <style id="critical-css">

    </style>
    <link rel="stylesheet" href="<?= buStatic('dist/style.css') ?>">
    <?php
    // 6. ALL SCRIPTS
    ?>
    <script defer src="<?= buStatic('dist/vendor.js') ?>"></script>
    <script defer src="<?= buStatic('dist/bundle.js') ?>"></script>
    <?php wp_head(); ?>
</head>
<body>
