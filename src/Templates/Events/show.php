<?php
  require_once __DIR__ . '/../_inc/header.php';
  require_once __DIR__ . '/../_inc/navbar.php';
?>

<h3 style="color: red">Show event</h3>

<button><a href="<?= '/event/' . $data['id'] . '/edit' ?>">Edit event</a></button>

<form action="<?= '/event/'. $data['id'] ?>" method="post">
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

<table>
    <tr>
        <td>Id</td>
        <td><?= $data['id'] ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?= $data['name'] ?></td>
    </tr>
    <tr>
        <td>City</td>
        <td><?= $data['city'] ?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?= $data['address'] ?></td>
    </tr>
    <tr>
        <td>Date</td>
        <td><?= $data['date'] ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?= $data['description'] ?></td>
    </tr>
    <tr>
        <td>Created at</td>
        <td><?= $data['created_at'] ?></td>
    </tr>
    <tr>
        <td>Updated at</td>
        <td><?= $data['updated_at'] ?></td>
    </tr>
</table>

<?php
  require_once __DIR__ . '/../_inc/footer.php';
?>