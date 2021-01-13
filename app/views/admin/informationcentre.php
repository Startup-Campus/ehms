<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php

    require APPROOT . '/views/includes/adminnav.php';

?>

<table class="applications">
    <tr>
        <th>Type</th>
        <th>Content</th>
    </tr>
    <?php foreach ($data as $info): ?>
    <?php
        if ($info->id % 2 == 0) {
            $class = "white";
        } else {
            $class = "grey";
        }
    ?>
    <tr class="<?php echo $class ?>">
        <td><?php echo $info->title ?></td>
        <td><?php if (strlen($info->content) > 40) {echo substr($info->content, 0, 40) . "...";} else {echo $info->content;}?></td>
        <td><a href="<?php echo URLROOT; ?>/administration/deleteinformation?id=<?php echo $info->id ;?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>

<center><a href="<?php echo URLROOT; ?>/administration/addinformation"><button class="btn-link">Add Info</button></a></center>

<?php

    require APPROOT . '/views/includes/adminfooter.php';

?>