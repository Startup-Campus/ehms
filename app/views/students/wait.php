<?php if (isset($_SESSION['student_id'])) : ?>
    <?php echo $data['message'] ?>
<?php else : ?>
    <?php header('location: ' . URLROOT . '/students/login') ?>
<?php endif; ?>