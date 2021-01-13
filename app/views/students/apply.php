<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if ($_SESSION['student_id']) : ?>
    <?php

    require APPROOT . '/views/includes/nav.php';

    ?>

    <div class="container-apply">
        <div class="wrapper-apply">
            <h2>Apply</h2>
            <form action="<?php echo URLROOT; ?>/students/apply" method="POST">
                <label>Student Name: </label><input type="text" placeholder="Student Name" name="name" value="<?php echo $_SESSION['student_name'] ?>" readonly><br />
                <label>Room Type: </label><input type="number" name="type" value="<?php echo $_SESSION['type']?>" readonly><br />
                <label>Student Email: </label><input type="email" name="email" placeholder="Email">
                <span class="invalidFeedback">*<?php echo $data['emailError'] ?></span><br />
                <label>Department: </label><input type="text" placeholder="Department" name="department">
                <span class="invalidFeedback">*</span><br />
                <label>Level: </label><input type="number" name="level" placeholder="Level (1-6)">
                <span class="invalidFeedback">*<?php echo $data['levelError'] ?></span><br />
                <label>Phone Number: </label><input type="number" name="phone" placeholder="Phone Number">
                <span class="invalidFeedback">*<?php echo $data['phoneError'] ?></span><br />
                <label>Date of Birth: </label><input type="date" name="dob">
                <span class="invalidFeedback">*<?php echo $data['dobError'] ?></span><br />
                <label>Age: </label><input type="number" name="age" placeholder="Age">
                <span class="invalidFeedback">*<?php echo $data['ageError'] ?></span><br />
                <label>Guardian Name: </label><input type="text" placeholder="Guardian Name" name="guardian_name">
                <span class="invalidFeedback">*<?php echo $data['guardianNameError'] ?></span><br />
                <label>Guardian Email: </label><input type="email" name="guardian_email" placeholder="Guardian Email">
                <span class="invalidFeedback">*<?php echo $data['guardianEmailError'] ?></span><br />
                <label>Guardian Phone Number: </label><input type="number" name="guardian_phone" placeholder="Guardian Phone Number">
                <span class="invalidFeedback">*<?php echo $data['guardianPhoneError'] ?></span><br />
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