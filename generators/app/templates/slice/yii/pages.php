<?php

define('PAGES_DIR', __DIR__ . '/pages/');

function getExternalLink($url = null)
{
    if ($url === null) {
        $url = htmlspecialchars($_SERVER['PHP_SELF']);
    }


    return 'http://' . getHostByName(getHostName()) . ':3000/' . ltrim($url, '/');
}

$externalUrl = getExternalLink();

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
    <section class="section styleguide__section section--qr">


        <div class="section__heading">
            <div class="container styleguide__container">
                <h2 class="styleguide__heading heading__h2">
                    BrowserSync access URLs
                </h2>
            </div>
        </div>
        <div class="container styleguide__container">
            <p>
                External:
                <a href="<?= $externalUrl?>" target="_blank">
                    <?= $externalUrl?>
                </a>
            </p>

            <!-- LOAD QRCode.js -->
            <script type="text/javascript" src="../node_modules/qrcodejs/qrcode.js"></script>
            <i id="qr-content" style="display: none;"><?= $externalUrl?></i>
            <div class="styleguide__qr" id="qr" style="
                display: inline-block;
                background-color: #ffffff;
                padding: 10px;
                ">

            </div>

            <!-- CREATE QR -->
            <script type="text/javascript">
                let qrEl = document.getElementById('qr');
                let qrContent = document.getElementById('qr-content').innerText;

                console.log(qrEl);
                console.log(qrContent);

                let qrcode = new QRCode(qrEl, {
                    text: qrContent,
                    width: 128,
                    height: 128,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
            </script>
        </div>

        <i class="styleguide__separator"></i>

    </section>

    <!-- //STYLEGUIDE -->
</div>

</body>
</html>