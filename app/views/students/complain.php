<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if ($_SESSION['student_id']) : ?>
    <?php

    require APPROOT . '/views/includes/nav.php';

    ?>

    <div class="container-apply">
        <div class="wrapper-apply">
            <h2>Lodge a Complaint</h2>
            <form action="<?php echo URLROOT; ?>/students/complain" method="POST">
                <textarea name="complaint" rows="20" cols="70" style="resize:none;" placeholder="Write complaint here..."></textarea><br />
                <span class="invalidFeedback">
                    *<?php echo $data['complaintError']; ?>
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