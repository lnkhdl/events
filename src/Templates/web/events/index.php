<?php
  require_once __DIR__ . '/../_inc/header.php';
  require_once __DIR__ . '/../_inc/navbar.php';
?>

<main>
    <section class="events-tbl">
    

        <?php
            if (!empty($_SESSION['success'])) {
                echo '<div style="color: green; padding-top: 10px; padding-bottom: 10px;"><b>! ! !' . $_SESSION['success'] . '! ! !</></div>';
                unset($_SESSION['success']);
            }
        ?>

        <?php
            if (empty($data)) {
                echo '<h2 style="text-align: center">Sorry, there are currently no events.</h2>';
            } else {
                ?>
                <h2>List of Events</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>City</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                
                            <?php
                            foreach ($data as $event) {
                                ?>
                                    <tr class="clickable-row">
                                        <td><a href="<?= '/event/' . $event['id'] ?>"><?= $event['name'] ?></a></td>
                                        <td data-label="City"><?= $event['city'] ?></td>
                                        <td data-label="Date"><?= $event['date'] ?></td>
                                        <td><a href="<?= '/event/' . $event['id'] ?>">Show more</a></td>
                                    </tr>
                                <?php
                            }
            } ?>
                </tbody>
            </table>
    </section>
</main>

<?php
  require_once __DIR__ . '/../_inc/footer.php';
?>