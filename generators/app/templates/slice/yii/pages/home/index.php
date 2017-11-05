<?php
// must be here
require_once __DIR__ . '/../../helpers/functions.php';

//front status
$statusFront = 0;

?>

<!DOCTYPE HTML>
<html>
<?php
render('layout/_head');
?>
<body>
<!-- HEADER -->
<?php
render('layout/partials/_navigation', [ ]);
?>

<!-- BARBA -->
<div id="barba-wrapper" class="main-rapper">
    <div class="barba-container">
        <div class="page-wrapper">
            <?php
            render('pages/home/partials/_header', [
                'className' => 'class-name'
            ]);
            ?>
        </div>

        <!-- FOOTER -->
        <?php
        render('layout/partials/_footer', [ ]);
        ?>
    </div>
</div>
<?php
render('layout/_scripts');
?>
</body>
</html>