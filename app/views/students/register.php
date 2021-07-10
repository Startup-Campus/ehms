<?php

    require APPROOT . '/views/includes/head.php';

?>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>
        <form action="<?php echo URLROOT; ?>/students/register" method="POST">
            <input type="text" placeholder="Full Name (surname last)" name="fullname">
            <span class="invalidFeedback">
                *<?php echo $data['fullnameError']; ?>
            </span><br />

            <input type="number" placeholder="Student ID" name="id">
            <span class="invalidFeedback">
                *<?php echo $data['idError']; ?>
            </span><br />

            <input type="password" placeholder="Password" name="password">
            <span class="invalidFeedback">
                *<?php echo $data['passwordError']; ?>
            </span><br />

            <input type="password" placeholder="Confirm Password" name="confirmPassword">
            <span class="invalidFeedback">
                *<?php echo $data['confirmPasswordError']; ?>
            </span><br />

            <button type="submit" id="submit" value="submit">Register</button>

            <p class="options">Already have an account? <a href="<?php echo URLROOT; ?>/students/login" class="default">Login</a></p>
        </form>
    </div>
</div>