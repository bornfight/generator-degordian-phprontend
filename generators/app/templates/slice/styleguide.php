<?php
// must be here
require_once __DIR__ . '/helpers/functions.php';
?>

<!DOCTYPE HTML>
<html>
<?php
render('layout/_head');
?>
<body>
<div class="main__wrapper main__wrapper--styleguide">
    <!-- STYLEGUIDE -->

    <!-- logo -->
    <section class="section styleguide__section section--logo">
        <div class="container styleguide__container">

        </div>
    </section>
    <!-- //logo -->

    <!-- typography -->
    <section class="section styleguide__section section--typography">
        <div class="section__heading">
            <div class="container styleguide__container">
                <p class="styleguide__heading">
                    Typography
                </p>
            </div>
        </div>
        <div class="container styleguide__container">

            <p class="above__title">
                This is above title.
            </p>
            <h1 class="title__h1">
                This is h1 heading.
            </h1>
            <h2 class="title__h2">
                This is h2 heading.
            </h2>
            <h3 class="title__h3">
                This is h3 heading.
            </h3>
            <h4 class="title__h4">
                This is h4 heading.
            </h4>
            <h5 class="title__h5">
                This is h5 heading.
            </h5>
            <p class="subtitle">
                This is subtitle.
            </p>
            <p>
                This is body text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores beatae error molestiae perferendis quas! Accusamus ad alias beatae cupiditate dolore dolorem exercitationem fuga modi natus odio, quisquam tenetur voluptas. Dolorem.
            </p>
        </div>
    </section>
    <!-- //typography -->

    <!-- colors -->
    <section class="section styleguide__section section--colors">

        <div class="section__heading">
            <div class="container styleguide__container">
                <p class="styleguide__heading">
                    Colors
                </p>
            </div>
        </div>
        <div class="container styleguide__container">
            <div class="color__block">
                <i class="color color--black"></i>
            </div>

            <div class="color__block">
                <i class="color color--dark-grey"></i>
            </div>

            <div class="color__block">
                <i class="color color--light-grey-a"></i>
            </div>

            <div class="color__block">
                <i class="color color--light-grey-b"></i>
            </div>

            <div class="color__block">
                <i class="color color--blue"></i>
            </div>

            <div class="color__block">
                <i class="color color--blue-text"></i>
            </div>

            <div class="color__block">
                <i class="color color--blue-text-A"></i>
            </div>

            <div class="color__block">
                <i class="color color--light-blue"></i>
            </div>

            <div class="color__block">
                <i class="color color--light-blue-A"></i>
            </div>

            <div class="color__block">
                <i class="color color--red"></i>
            </div>

            <div class="color__block">
                <i class="color color--green"></i>
            </div>
        </div>
    </section>
    <!-- //colors -->

    <!-- buttons -->
    <section class="section styleguide__section section--buttons">

        <div class="section__heading">
            <div class="container styleguide__container">
                <p class="styleguide__heading">
                    Buttons
                </p>
            </div>
        </div>
        <div class="container styleguide__container">
            <a href="<?=bu('slice/pages/home/index.php');?>" class="button button--blue">Button blue</a>
            <a href="<?=bu('slice/pages/home/index.php');?>" class="button button--white">Button white</a>
        </div>
    </section>
    <!-- //buttons -->

    <!-- icons -->
    <section class="section styleguide__section section--buttons">

        <div class="section__heading">
            <div class="container styleguide__container">
                <p class="styleguide__heading">
                    Icons
                </p>
            </div>
        </div>
        <div class="container styleguide__container">

        </div>
    </section>
    <!-- //icons -->

    <!-- pagination -->
    <section class="section styleguide__section section--pagination">

        <div class="section__heading">
            <div class="container styleguide__container">
                <p class="styleguide__heading">
                    Pagination
                </p>
            </div>
        </div>
        <div class="container styleguide__container">

            <?php
            //render('layout/partials/_pagination');
            ?>
        </div>
    </section>
    <!-- //pagination -->
    <!-- //STYLEGUIDE -->
</div>
<?php
render('layout/_scripts');
?>
</body>
</html>