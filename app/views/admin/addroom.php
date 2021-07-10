<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if (isset($_SESSION['admin_id'])) : ?>
    <?php

        require APPROOT . '/views/includes/adminnav.php';

    ?><br /><br />
    <form action="<?php echo URLROOT; ?>/administration/addroom" method = 'POST'>
    Room Number: <input type="number" name="number">
    <span class="invalidFeedback">*<?php echo $data['priceError']; ?></span><br />
    Capacity: <input type="number" name="capacity">
    <span class="invalidFeedback">*<?php echo $data['priceError']; ?></span><br />
    Type: <input type="number" name="type">
    <span class="invalidFeedback">*<?php echo $data['priceError']; ?></span><br />
    Price <input type="number" name="price">
    <span class="invalidFeedback">*<?php echo $data['priceError']; ?></span><br />
    <button type="submit" style="cursor: pointer;">Add</button>
    </form>

    <?php

        require APPROOT . '/views/includes/footer.php';

    ?>
<?php else :?>
    <?php header('loaction: ' . URLROOT . 'administration/login'); ?>
<?php endif; ?>