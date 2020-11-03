<?php
  require_once __DIR__ . '/../_inc/header.php';
  require_once __DIR__ . '/../_inc/navbar.php';
?>

<main>
    <section class="single-event">

    <h2><?= $data[0]['name'] ?></h2>

    <img src="/../assets/img/icon_place.png" alt="place icon" class="place-img"/>
    <span class="city"><?= $data[0]['city'] ?></span>
    <span class="address"><?= $data[0]['address'] ?></span>

    <img src="/../assets/img/icon_calendar.png" alt="calendar icon" class="date-img"/>
    <span class="date"><?= $data[0]['date'] ?></span>

    <a href="<?= '/event/' . $data[0]['id'] . '/member/create' ?>" class="add-btn">Add member</a>
    <a href="<?= '/event/' . $data[0]['id'] . '/edit' ?>" class="edit-btn">Edit event</a>

    <form action="<?= '/event/'. $data[0]['id'] ?>" method="post" class="delete-form">
        <input type="hidden" name="_method" value="delete">
        <input class="delete-btn" type="submit" value="Delete event">
    </form>

    <?php
        if (!empty($_SESSION['success'])) {
            echo '<div style="color: green; padding-top: 10px; padding-bottom: 10px;"><b>! ! !' . $_SESSION['success'] . '! ! !</></div>';
            unset($_SESSION['success']);
        }
        if (!empty($_SESSION['error'])) {
            echo '<div style="color: red; padding-top: 10px; padding-bottom: 10px;"><b>! ! !' . $_SESSION['error'] . '! ! !</></div>';
            unset($_SESSION['error']);
        }
    ?>

    <p class="description">
        <?= $data[0]['description'] ?>
    </p>

    <div class="tbl members-tbl">
        <h2>List of Members</h2>
        <?php
            if (empty($data[1]['id'])) {
                echo '<h4>There are currently no members registered to this event.</h4>';
            } else {
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                <?php
                    // start from 1 because the first part of the data array is the event data used above
                    for ($member = 1; $member <= count($data)-1; $member++) {
                        ?>
                        <tr>
                            <td><?= $data[$member]['first_name'] ?></td>
                            <td><?= $data[$member]['last_name'] ?></td>
                            <td>
                                <a href="<?= '/event/' . $data[0]['id'] . '/member/' . $data[$member]['id'] . '/edit' ?>">Edit</a>
                            </td>
                            <td>
                                <form action="<?= '/event/' . $data[0]['id'] . '/member/' . $data[$member]['id'] ?>" method="post">
                                    <input type="hidden" name="_method" value="delete">
                                    <input class="input-to-btn member-delete-btn" type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
    </div>
    </section>
</main>
<?php
  require_once __DIR__ . '/../_inc/footer.php';
?>