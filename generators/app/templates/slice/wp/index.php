<?php
function getExternalLink($url = null)
{
    if ($url === null) {
        $url = htmlspecialchars($_SERVER['PHP_SELF']);
    }

    return 'http://' . getHostByName(getHostName()) . ':3000/' . ltrim($url, '/');
}

$externalUrl = getExternalLink();
?>

<div class="slice">
    <!-- HEADER -->
    <div class="slice__header">
        <div class="slice__logo">

        </div>
    </div>
    <!-- //HEADER -->
    <!-- CONTENT -->
    <div class="slice__content">

        <section class="slice__section">

            <div class="slice__heading">
                <h3>Pages</h3>
            </div>

            <?php

            require_once __DIR__ . '/core/ini.php';

            echo '<ul class="slice__pages">';
            foreach (glob(__DIR__ . '/page-templates/*.php') as $filename) {

                $chunks = explode('page-templates/', $filename);

                if (count($chunks) === 2) {
                    echo '<li>
                
                    <a class="slice__link" target="_blank" href="page-templates/' . $chunks[1] . '">' . strtoupper(str_replace('.php', '',
                            $chunks[1])) . '</a>
                    
                        <div class="slice__status">
                            <p>status: <span>0%</span></p>
                            <i class="slice__status-completeness">
                                <i data-front-status="0"></i>
                            </i>
                        </div>
                    
                    </li>';
                }

            }
            echo '</ul>';
            ?>

            <i class="slice__separator"></i>
        </section>
        <section class="slice__section slice__section--qr">


            <div class="section__heading">
                <div class="slice__heading">
                    <h3>BrowserSync access URLs</h3>
                </div>
            </div>
            <p>
                External:
                <a class="slice__link" href="<?= $externalUrl?>" target="_blank">
                    <?= $externalUrl?>
                </a>
            </p>

            <!-- LOAD QRCode.js -->
            <script type="text/javascript" src="../node_modules/qrcodejs/qrcode.js"></script>
            <i id="qr-content" style="display: none;"><?= $externalUrl?></i>
            <div class="slice__qr" id="qr" style="
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

            <i class="slice__separator"></i>

        </section>

    </div>
    <!-- //CONTENT -->
    <div class="slice__styleguide">
        <section class="slice__section">

            <div class="slice__heading">
                <h3>Styleguide</h3>
            </div>

            <i class="slice__separator"></i>
        </section>

    </div>
</div>