<?php

    require APPROOT . '/views/includes/head.php';

?>

<?php if (isset($_SESSION['student_id'])) : ?>
    <?php

          require APPROOT . '/views/includes/nav.php';

    ?>


    <div class="container">
        <section id="view-app">
            <div class="app-info">
                <table class="application">
                    <tr>
                        <th>Title</td>
                        <th><?php echo $data->title ?></li></td>
                    </tr>
                    <tr>
                        <td>Content</td>
                        <td><?php echo $data->content ?></td>
                    </tr>
                </table>
            </div>
        </section>
    </div>

    <?php

        require APPROOT . '/views/includes/footer.php';

    ?>

<?php else :?>
    <?php header('location: ' . URLROOT . 'students/login') ?>
<?php endif; ?>