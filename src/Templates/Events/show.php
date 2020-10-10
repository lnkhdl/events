<?php
  require_once __DIR__ . '/../_inc/header.php';
  require_once __DIR__ . '/../_inc/navbar.php';
?>

<h3 style="color: red">Show event</h3>

<button><a href="<?= '/event/' . $data[0]['id'] . '/edit' ?>">Edit event</a></button>
<button><a href="<?= '/event/' . $data[0]['id'] . '/member/create' ?>">Add new member</a></button>

<form action="<?= '/event/'. $data[0]['id'] ?>" method="post">
    <input type="hidden" name="_method" value="delete">
    <input type="submit" value="Delete event">
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

<h4 style="color: blue">Event details:</h4>
<table>
    <tr>
        <td>Id</td>
        <td><?= $data[0]['id'] ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?= $data[0]['name'] ?></td>
    </tr>
    <tr>
        <td>City</td>
        <td><?= $data[0]['city'] ?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?= $data[0]['address'] ?></td>
    </tr>
    <tr>
        <td>Date</td>
        <td><?= $data[0]['date'] ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?= $data[0]['description'] ?></td>
    </tr>
    <tr>
        <td>Created at</td>
        <td><?= $data[0]['created_at'] ?></td>
    </tr>
    <tr>
        <td>Updated at</td>
        <td><?= $data[0]['updated_at'] ?></td>
    </tr>
</table>

<h4 style="color: blue">Members details:</h4>
<?php
    if (empty($data[1]['id'])) {
        echo 'No members found.';
    } else {
        ?>
        <table style="border: 1px solid black;">
            <thead>
                <tr>
                    <th>id</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th>email</th>
                    <th>event_id</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>edit</th>
                    <th>delete</th>
                </tr>
            </thead>
        <?php
            // start from 1 because the first part of the data array is the event data used above
            for ($member = 1; $member <= count($data)-1; $member++) {
                ?>
                <tr>
                    <td><?= $data[$member]['id'] ?></td>
                    <td><?= $data[$member]['first_name'] ?></td>
                    <td><?= $data[$member]['last_name'] ?></td>
                    <td><?= $data[$member]['email'] ?></td>
                    <td><?= $data[$member]['event_id'] ?></td>
                    <td><?= $data[$member]['created_at'] ?></td>
                    <td><?= $data[$member]['updated_at'] ?></td>
                    <td>
                        <button><a href="<?= '/event/' . $data[0]['id'] . '/member/' . $data[$member]['id'] . '/edit' ?>">Edit</a></button>
                    </td>
                    <td>
                        <form action="<?= '/event/' . $data[0]['id'] . '/member/' . $data[$member]['id'] ?>" method="post">
                            <input type="hidden" name="_method" value="delete">
                            <input type="submit" value="Delete member">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>

<?php
  require_once __DIR__ . '/../_inc/footer.php';
?>