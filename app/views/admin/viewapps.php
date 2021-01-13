<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php

    require APPROOT . '/views/includes/adminnav.php';

?>
<table class="applications">
    <tr>
        <th>Student Name</th>
        <th>Student ID</th>
        <th>Age</th>
        <th>Verified</th>
    </tr>
<?php foreach ($data as $key => $val) : ?>
    <?php
        if ($val->status == 0) {
            $val->status = "No";
            $class = 'red';
        } else {
            $val->status = "Yes";
            $class = 'green';
        }
    ?>
    <?php
        echo "<tr class=" . $class . ">\n";
        echo "\t\t\t<td>" . "<a href=" . URLROOT . "/administration/viewapp?id=" . $val->student_id . ">" . $val->student_name . "</a></td>\n";
        echo "\t\t\t<td>" . "<a href=" . URLROOT . "/administration/viewapp?id=" . $val->student_id . ">" . $val->student_id . "</a></td>\n";
        echo "\t\t\t<td>" . "<a href=" . URLROOT . "/administration/viewapp?id=" . $val->student_id . ">" . $val->age . "</a></td>\n";
        echo "\t\t\t<td>" . "<a href=" . URLROOT . "/administration/viewapp?id=" . $val->student_id . ">" . $val->status . "</a></td>\n";
        echo "\t\t</tr>\n";
    ?>
<?php endforeach; ?>
</table>


<?php

    require APPROOT . '/views/includes/adminfooter.php';

?>

