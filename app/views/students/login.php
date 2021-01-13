<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if(!isset($_SESSION['student_id'])) : ?>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Login</h2>
        <form action="<?php echo URLROOT; ?>/students/login" method="POST">
            <input type="number" placeholder="Student ID" name="id">
            <span class="invalidFeedback">
                *<?php echo $data['idError']; ?>
            </span><br />
            <input type="password" placeholder="Password" name="password">
            <span class="invalidFeedback">
                *<?php echo $data['passwordError']; ?>
            </span><br />
            <button type="submit" id="submit" value="submit">Login</button>
            <p class="options">Not registered yet? <a href="<?php echo URLROOT; ?>/students/register" class="default">Create an account</a></p>
        </form>
    </div>
</div>

<?php else : ?>
    
    <?php header('location:' . URLROOT . '/students/index'); ?>

<?php endif; ?>

