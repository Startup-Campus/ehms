<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php

    require APPROOT . '/views/includes/adminnav.php';

?>

    <table class="applications">
        <?php if ($_GET['name'] == 'rooms') : ?>
            <tr>
                <th>Room Number</th>
                <th>Capacity</th>
                <th>Type</th>
            </tr>
            <?php foreach ($data as $room): ?>
            <?php 
                if ($room->room_number % 2 == 0) {
                    $class = "white";
                } else {
                    $class = "grey";
                }
            ?>
            <tr class=<?php echo $class; ?>>
                <td><?php echo $room->room_number; ?></td>
                <td><?php echo $room->capacity; ?></td>
                <td><?php echo $room->room_type; ?></td>
                <td><a href="<?php echo URLROOT; ?>/administration/deleteroom?number=<?php echo $room->room_number ;?>">Delete</a></td>
            </tr>
            <?php endforeach; ?>
        <?php elseif ($_GET['name'] == 'inventory') : ?>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
            </tr>

            <?php foreach ($data as $item): ?>
            <?php 
                if ($item->id % 2 == 0) {
                    $class = "white";
                } else {
                    $class = "grey";
                }
            ?>
            <tr class=<?php echo $class; ?>>
                <td><?php echo $item->item_name; ?></td>
                <td><?php echo $item->quantity; ?></td>
                <td><a href="<?php echo URLROOT; ?>/administration/deleteitem?name=<?php echo $item->item_name ;?>">Delete</a></td>
            </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Room Number</th>
                <th>Fees Paid</th>
                <th>Room Allocated</th>
            </tr>
            <?php foreach ($data as $student) : ?>
                <?php 
                    if ($student->id % 2 == 0) {
                        $class = "white";
                    } else {
                        $class = "grey";
                    }

                    if ($student->fees_paid == 0) {
                        $student->fees_paid = "No";
                    } else {
                        $student->fees_paid = "Yes";
                    }

                    if ($student->room_allocated == 0) {
                        $student->room_allocated = "No";
                    } else {
                        $student->room_allocated = "Yes";
                    }

                    if (is_null($student->room_number)) {
                        $student->room_number = "None";
                    }
                ?>
                <tr class=<?php echo $class; ?>>
                    <td><?php echo $student->full_name; ?></td>
                    <td><?php echo $student->student_id; ?></td>
                    <td><?php echo $student->room_number; ?></td>
                    <td><?php echo $student->fees_paid; ?></td>
                    <td><?php echo $student->room_allocated; ?></td>
                    <td><a href="<?php echo URLROOT; ?>/administration/deletestudent?id=<?php echo $student->student_id ;?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <?php if ($_GET['name'] == 'rooms') : ?>
        <center><a href="<?php echo URLROOT; ?>/administration/addroom"><button class="btn-link">Add Room</button></a></center>
    <?php elseif ($_GET['name'] = 'inventory') :?>
        <center><a href="<?php echo URLROOT; ?>/administration/additem"><button class="btn-link">Add Item</button></a></center>
    <?php endif; ?>

<?php

    require APPROOT . '/views/includes/adminfooter.php';

?>