<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if(!isset($_SESSION['student_id'])) : ?>
    <?php header('location: ' . URLROOT . '/students/login') ?>

<?php else : ?>

    <div class="container">
        <?php

            require APPROOT . '/views/includes/nav.php';

        ?>
        <section id="admin-home">
            <a href="mailto:obriggs03@gmail.com" target="_blank">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    <p>contact hostel agent</p>
                </div>
            </a>
            <a href="<?php echo URLROOT; ?>/students/complain">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                    <p>lodge a complaint</p>
                </div>
            </a>
            <a href="<?php echo URLROOT; ?>/students/bookcounselor">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-plus" aria-hidden="true"></i></span>
                    <p>book a counselor</p>
                </div>
            </a>
        </section>

    </div>

    <?php

        require APPROOT . '/views/includes/footer.php';

    ?>
<?php endif; ?>