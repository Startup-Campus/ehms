<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if(!isset($_SESSION['admin_id'])) : ?>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Login</h2>
        <form action="<?php echo URLROOT; ?>/administration/login" method="POST">
            <input type="text" placeholder="Username" name="username">
            <span class="invalidFeedback">
                *<?php echo $data['usernameError']; ?>
            </span><br />
            <input type="password" placeholder="Password" name="password">
            <span class="invalidFeedback">
                *<?php echo $data['passwordError']; ?>
            </span><br />
            <button type="submit" id="submit" value="submit">Login</button>
        </form>
    </div>
</div>

<?php else : ?>
    <?php header('location:' . URLROOT . '/administration/index'); ?>

<?php endif; ?>

