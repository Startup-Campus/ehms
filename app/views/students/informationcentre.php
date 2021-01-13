<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if (isset($_SESSION['student_id'])) : ?>
    <?php

        require APPROOT . '/views/includes/nav.php';

    ?>

    <table class="applications">
        <tr>
            <th>Type</th>
            <th>Content</th>
        </tr>
        <?php foreach ($data as $info): ?>
        <?php
            $class = "grey";
        ?>
        <tr class="<?php echo $class ?>">
            <td><?php echo "<a href='" . URLROOT . "/students/viewinformation?id=" . $info->id . "'>" .  $info->title  . "</a>"?></td>
            <td><?php if (strlen($info->content) > 40) {echo "<a href='" . URLROOT . "/students/viewinformation?id=" . $info->id . "'>" . substr($info->content, 0, 40) . "...</a>";} else {echo "<a href='" . URLROOT . "students/viewinformation?id=" . $info->id . "'>" . $info->content . "</a>";}?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php

        require APPROOT . '/views/includes/footer.php';

    ?>

<?php else: ?>
    <?php header('location: ' . URLROOT . '/students/login') ?>

<?php endif; ?>