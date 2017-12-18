<?php

define('PAGES_DIR', __DIR__ . '/pages/');

require_once __DIR__ . '/helpers/functions.php';

?><!DOCTYPE HTML>
<html>
<?php
render('layout/_head');
?>
<body>
<div class="main__wrapper main__wrapper--styleguide">
    <!-- STYLEGUIDE -->
    <header>
        <h1>Header</h1>
    </header>
    <!-- logo -->
    <section class="section styleguide__section section--logo">
        <div class="container styleguide__container">

        </div>
    </section>
    <!-- //logo -->

    <!-- pages -->
    <section class="section styleguide__section section--pages">

        <div class="section__heading">
            <div class="container styleguide__container">
                <p class="styleguide__heading heading__h2">
                    Pages
                </p>
            </div>
        </div>
        <div class="container styleguide__container">
            <ul class="styleguide__pages">
                <?php
                $dirs = array_filter(glob(PAGES_DIR . '*'), 'is_dir');

                foreach($dirs as $directory) {
                    $pageDir = getPageDir(PAGES_DIR, $directory);
                    $subPages = getFirstLevelPages(PAGES_DIR . $pageDir);
                    ?>
                    <li class="styleguide__pages-directory">
                        <?= strtoupper($pageDir) ?>
                    </li>
                    <?php

                    foreach($subPages as $subPage) {
                        ob_start();
                        require_once( $subPage );
                        ob_end_clean();
                        ?>
                        <li>
                            <a target="_blank" href="<?= getPageUrl($subPage) ?>"><?= getPageName($subPage) ?></a>
                            <span>
                                <i>status: <span><?=$statusFront?>%</span></i>
                                <i class="styleguide__pages-status">
                                    <i style="width: <?=$statusFront . '%'?>"></i>
                                </i>
                            </span>
                        </li>


                        <?php
                        unset( $statusFront );
                    }

                } ?>
            </ul>
        </div>

        <i class="styleguide__separator"></i>

    </section>
    <!-- //pages -->

    <!-- //STYLEGUIDE -->
</div>

</body>
</html>