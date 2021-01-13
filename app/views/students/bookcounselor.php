<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if ($_SESSION['student_id']) : ?>
    <?php

    require APPROOT . '/views/includes/nav.php';

    ?>

    <div class="container-apply">
        <div class="wrapper-appointment">
            <h2>Book a Counseling  Appointment</h2>
            <form action="<?php echo URLROOT; ?>/students/bookcounselor" method="POST">
                <label>Appointment Date: </label><input type="date" name="date">
                <span class="invalidFeedback">
                    *<?php echo $data['dateError']; ?>
                </span><br />
                <label>Appointment Time: </label><input type="time" name="time">
                <span class="invalidFeedback">
                    *<?php echo $data['timeError']; ?>
                </span><br />
                <button type="submit" id="submit" value="submit">Submit</button>
            </form>
        </div>
    </div>

    <?php

    require APPROOT . '/views/includes/footer.php';

    ?>
<?php else: ?>
    <?php header('location: ' . URLROOT . '/students/login') ?>
<?php endif; ?>