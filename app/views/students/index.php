<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if(!isset($_SESSION['student_id'])) : ?>
    <?php header('location: ' . URLROOT . '/students/login') ?>

<?php else : ?>
    <div class="container">
        <header id="admin-header">
            <span id="logo">
                <a href="https://www.nileuniversity.edu.ng"><img src="<?php echo URLROOT; ?>/img/logo.png" alt="Nile University of Nigeria"></a>
            </span>
        </header>
        <section id="admin-home">
            <a href="<?php echo URLROOT;?>/students/viewrooms">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-bed" aria-hidden="true"></i></span>
                    <p>view rooms</p>
                </div>
            </a>
            <a href="<?php echo URLROOT; ?>/students/support">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    <p>hostel support</p>
                </div>
            </a>
            <a href="<?php echo URLROOT; ?>/students/informationcentre">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                    <p>information centre</p>
                </div>
            </a>
        </section>

    </div>

    <?php

        require APPROOT . '/views/includes/footer.php';

    ?>
<?php endif; ?>