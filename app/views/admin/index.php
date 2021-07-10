<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if(!isset($_SESSION['admin_id'])) : ?>
    <?php header('location: ' . URLROOT . '/administration/login') ?>

<?php else : ?>
    <div class="container">
        <header id="admin-header">
            <span id="logo">
                <a href="https://www.nileuniversity.edu.ng"><img src="<?php echo URLROOT; ?>/img/logo.png" alt="Nile University of Nigeria"></a>
            </span>
        </header>
        <section id="admin-home">
            <a href="<?php echo URLROOT;?>/administration/viewapps" class="inherit">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-check-square-o" aria-hidden="true"></i></span>
                    <p>view applications</p>
                </div>
            </a>
            <a href="<?php echo URLROOT; ?>/administration/viewrecords" class="inherit">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                    <p>view records</p>
                </div>
            </a>
            <a href="<?php echo URLROOT; ?>/administration/informationcentre" class="inherit">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                    <p>information centre</p>
                </div>
            </a>
        </section>

    </div>

    <?php

        require APPROOT . '/views/includes/adminfooter.php';

    ?>
<?php endif; ?>