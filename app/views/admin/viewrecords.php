<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php

    require APPROOT . '/views/includes/adminnav.php';

?>

<div class="container">
        <section id="admin-home">
            <a href="<?php echo URLROOT;?>/administration/viewrecord?name=students">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                    <p>view students</p>
                </div>
            </a>
            <a href="<?php echo URLROOT; ?>/administration/viewrecord?name=rooms">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-bed" aria-hidden="true"></i></span>
                    <p>view rooms</p>
                </div>
            </a>
            <a href="<?php echo URLROOT; ?>/administration/viewrecord?name=inventory">
                <div class="card">
                    <span class="card-icon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <p>view inventory</p>
                </div>
            </a>
        </section>
</div>

<?php

    require APPROOT . '/views/includes/adminfooter.php';

?>