<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if (isset($_SESSION['admin_id'])) : ?>
    <?php

        require APPROOT . '/views/includes/adminnav.php';

    ?><br /><br />
    <form action="<?php echo URLROOT; ?>/administration/addinformation" method = 'POST'>
    Title: <input type="name" name="title">
    <span class="invalidFeedback">*<?php echo $data['titleError']; ?></span><br />
    Content: <br />
    <textarea name="content" cols="30" rows="20" style="resize: none;"></textarea>
    <span class="invalidFeedback">*<?php echo $data['contentError']; ?></span><br />
    <button type="submit" style="cursor: pointer;">Add</button>
    </form>

    <?php

        require APPROOT . '/views/includes/footer.php';

    ?>
<?php else :?>
    <?php header('loaction: ' . URLROOT . 'administration/login'); ?>
<?php endif; ?>