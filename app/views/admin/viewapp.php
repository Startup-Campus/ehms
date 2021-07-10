<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php

    require APPROOT . '/views/includes/adminnav.php';

?>

<?php
if ($data->status == 0) {
    $data->status = "Unverified";
} else {
    $data->status = "Verified";
}
?>

<div class="container">
    <section id="view-app">
        <div class="app-info">
            <table class="application">
                <tr>
                    <td>Student Name</td>
                    <td><?php echo $data->student_name ?></li></td>
                </tr>
                <tr>
                    <td>Student ID</td>
                    <td><?php echo $data->student_id ?></td>
                </tr>
                <tr>
                    <td>Room type</td>
                    <td><?php echo $data->room_type ?></td>
                </tr>
                <tr>
                    <td>Verification Status</td>
                    <td><?php echo $data->status ?></td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td><?php echo $data->age ?></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><?php echo $data->contact_no ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $data->contact_email ?></td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><?php echo $data->date_of_birth ?></td>
                </tr>
                <tr>
                    <td>Level</td>
                    <td><?php echo $data->level ?></td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td><?php echo $data->department ?></td>
                </tr>
                <tr>
                    <td>Guardian Name</td>
                    <td><?php echo $data->guardian_name ?></td>
                </tr>
                <tr>
                    <td>Guardian Phone Number</td>
                    <td><?php echo $data->guardian_no ?></td>
                </tr>
                <tr>
                    <td>Guardian Email</td>
                    <td><?php echo $data->guardian_email ?></td>
                </tr>
            </table>
            <?php if ($data->status == "Unverified") : ?>
                <a href="<?php echo URLROOT; ?>/administration/verify?id=<?php echo $data->student_id; ?>"><button class="btn-link">Verify</button></a>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php

    require APPROOT . '/views/includes/adminfooter.php';

?>