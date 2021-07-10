<?php if(isset($_SESSION['student_id'])) : ?>

<nav class="top-nav">
    <span id="logo"><a href="https://www.nileuniversity.edu.ng"><img src="<?php echo URLROOT; ?>/img/logo-white.png" alt="Nile University of Nigeria"></a></span>
    <ul>
        <li><a href="<?php echo URLROOT; ?>/students/index">Home</a></li>
        <li><a href="<?php echo URLROOT; ?>/students/viewrooms">View Rooms</a></li>
        <?php if ($_SESSION['room_allocated']) : ?>
        <li><a href="<?php echo URLROOT; ?>/students/payfees">Pay Fees</a></li>
        <?php endif; ?>
        <li><a href="<?php echo URLROOT; ?>/students/support">Hostel Support</a></li>
        <li><a href="<?php echo URLROOT; ?>/students/informationcentre">Information Centre</a></li>
        <li class="btn-login"><a href="<?php echo URLROOT; ?>/students/logout">Logout</a></li>
    </ul>
</nav>

<p class="center"><?php echo $_SESSION['student_name'] . "<br /><b>" . $_SESSION['student_id'] . "</b>"?></p>

<?php else : ?>
    <?php header('location: ' . URLROOT . '/students/login') ?>
<?php endif; ?>