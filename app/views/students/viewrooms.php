<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if(!isset($_SESSION['student_id'])) : ?>
    <?php header('location: ' . URLROOT . '/students/login') ?>

<?php else : ?>

    <?php

    require APPROOT . '/views/includes/nav.php';

    ?>

    <div class="container">
        <section id="viewrooms">
            <div class="card room-card">
                <div class="room-img">
                    <img src="https://via.placeholder.com/210X180" alt="Room of 2">
                </div>
                <p>room of 2</p>
                <?php if ($data['type2']) : ?>
                    <a href="<?php echo URLROOT; ?>/students/apply?type=2" class="default">Apply now</a>
                <?php else: ?>
                    <span class="invalidFeedback">Unavailable</span><br />
                    <a href="<?php echo URLROOT; ?>/students/wait?type=2" class="default">Join Waiting List</a>
                <?php endif; ?>
            </div>
            <div class="card room-card">
                <div class="room-img">
                    <img src="https://via.placeholder.com/210X180" alt="Room of 3">
                </div>
                <p>room of 3</p>
                <?php if ($data['type3']) : ?>
                    <a href="<?php echo URLROOT; ?>/students/apply?type=3" class="default">Apply now</a>
                <?php else: ?>
                    <span class="invalidFeedback">Unavailable</span><br />
                    <a href="<?php echo URLROOT; ?>/students/wait?type=3" class="default">Join Waiting List</a>
                <?php endif; ?>
            </div>
            <div class="card room-card">
                <div class="room-img">
                    <img src="https://via.placeholder.com/210X180" alt="Room of 4">
                </div>
                <p>room of 4</p>
                <?php if ($data['type4']) : ?>
                    <a href="<?php echo URLROOT; ?>/students/apply?type=4" class="default">Apply now</a>
                <?php else: ?>
                    <span class="invalidFeedback">Unavailable</span><br />
                    <a href="<?php echo URLROOT; ?>/students/wait?type=4" class="default">Join Waiting List</a>
                <?php endif; ?>
            </div>
            <div class="card room-card">
                <div class="room-img">
                    <img src="https://via.placeholder.com/210X180" alt="Room of 5">
                </div>
                <p>room of 5</p>
                <?php if ($data['type5']) : ?>
                    <a href="<?php echo URLROOT; ?>/students/apply?type=5" class="default">Apply now</a>
                <?php else: ?>
                    <span class="invalidFeedback">Unavailable</span><br />
                    <a href="<?php echo URLROOT; ?>/students/wait?type=5" class="default">Join Waiting List</a>
                <?php endif; ?>
            </div>
            <div class="card room-card">
                <div class="room-img">
                    <img src="https://via.placeholder.com/210X180" alt="Room of 6">
                </div>
                <p>room of 6</p>
                <?php if ($data['type6']) : ?>
                    <a href="<?php echo URLROOT; ?>/students/apply?type=6" class="default">Apply now</a>
                <?php else: ?>
                    <span class="invalidFeedback">Unavailable</span><br />
                    <a href="<?php echo URLROOT; ?>/students/wait?type=6" class="default">Join Waiting List</a>
                <?php endif; ?>
            </div>
        </section>

    </div>

    <?php

    require APPROOT . '/views/includes/footer.php';

    ?>

<?php endif; ?>