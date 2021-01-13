<?php if(isset($_SESSION['admin_id'])) : ?>
<nav class="top-nav">
    <span id="logo"><a href="https://www.nileuniversity.edu.ng"><img src="<?php echo URLROOT; ?>/img/logo-white.png" alt="Nile University of Nigeria"></a></span>
    <ul>
        <li><a href="<?php echo URLROOT; ?>/administration/index">Home</a></li>
        <li><a href="<?php echo URLROOT; ?>/administration/viewapps" style="<?php if($_SERVER['REQUEST_URI'] ==  '/ehms/administration/viewapps') {echo "color:#a1a1a1;";}?>">View Applications</a></li>
        <li><a href="<?php echo URLROOT; ?>/administration/viewrecords" style="<?php if($_SERVER['REQUEST_URI'] ==  '/ehms/administration/viewrecords' || $_SERVER['REQUEST_URI'] ==  '/ehms/administration/viewrecord') {echo "color:#a1a1a1;";}?>">View Records</a></li>
        <li><a href="<?php echo URLROOT; ?>/administration/informationcentre" style="<?php if($_SERVER['REQUEST_URI'] ==  '/ehms/administration/informationcentre') {echo "color:#a1a1a1;";}?>">Information Centre</a></li>
        <li class="btn-login">
            <a href="<?php echo URLROOT; ?>/administration/logout">Logout</a>
        </li>
    </ul>
</nav>

<?php else : ?>
    <?php header('location: ' . URLROOT . '/administration/login') ?>
<?php endif; ?>
