<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if (isset($_SESSION['admin_id'])) : ?>
    <?php

        require APPROOT . '/views/includes/adminnav.php';

    ?><br /><br />
    <form action="<?php echo URLROOT; ?>/administration/additem" method = 'POST'>
    Item Name: <input type="name" name="name">
    <span class="invalidFeedback">*<?php echo $data['nameError']; ?></span><br />
    Quantity: <input type="number" name="quantity">
    <span class="invalidFeedback">*<?php echo $data['quantityError']; ?></span><br />
    <button type="submit" style="cursor: pointer;">Add</button>
    </form>

    <?php

        require APPROOT . '/views/includes/footer.php';

    ?>
<?php else :?>
    <?php header('loaction: ' . URLROOT . 'administration/login'); ?>
<?php endif; ?>