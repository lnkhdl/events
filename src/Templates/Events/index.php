<?php
  require_once __DIR__ . '/../_inc/header.php';
  require_once __DIR__ . '/../_inc/navbar.php';
?>

<h3 style="color: red">Events - Index</h3>

<?php
    if (!empty($_SESSION['success'])) {
        echo '<div style="color: green; padding-top: 10px; padding-bottom: 10px;"><b>! ! !' . $_SESSION['success'] . '! ! !</></div>';
        unset($_SESSION['success']);
    }
?>

<?php foreach ($data as $event): ?>
    <hr>
    <table>
        <tr>
            <td>Id</td>
            <td><a href="<?= '/event/' . $event->id ?>"><?= $event->id ?></a></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><?= $event->name ?></td>
        </tr>
        <tr>
            <td>City</td>
            <td><?= $event->city ?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><?= $event->address ?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td><?= $event->date ?></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><?= $event->description ?></td>
        </tr>
        <tr>
            <td>Created at</td>
            <td><?= $event->created_at ?></td>
        </tr>
        <tr>
            <td>Updated at</td>
            <td><?= $event->updated_at ?></td>
        </tr>
    </table>
<?php endforeach ?>

<?php
  require_once __DIR__ . '/../_inc/footer.php';
?>