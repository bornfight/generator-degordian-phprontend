<?php

require_once __DIR__ . '/../core/ini.php';

//WP HEADER
get_header();

//NAVIGATION
get_partial('layout/navigation', []);

//HOME HEADER
get_partial('home/header', [
    'headerClass' => 'header--home',
    'title' => 'Home title',
    'subtitle' => 'Home subtitle',
]);

?>

<div id="barba-wrapper" class="main-wrapper">
    <div class="barba-container">

        <!-- GET PARTIAL /W RETURN -->
        <div>
            <?php

            $content = get_partial('home/intro', [
                'title' => 'Intro title u get_partial sa returnom',
            ], true);

            echo $content;

            ?>
        </div>
        <!-- //GET PARTIAL /W RETURN -->

        <!-- GET PARTIAL -->
        <?php

        get_partial('home/intro', [
            'title' => 'Intro title u get_partial',
        ]);

        ?>
        <!-- //GET PARTIAL -->

        <div>
            <p>Ja sam image pozvan sa bu()</p>
            <img src="<?= bu('images/image.jpg'); ?>" alt="image">
        </div>

    </div>
</div>

<?php

get_partial('layout/footer', [
        'footerClass' => 'footer--home',
]);

//WP FOOTER
get_footer();