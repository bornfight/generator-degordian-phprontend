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