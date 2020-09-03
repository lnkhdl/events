<?php
    require_once(__DIR__ . '/../_inc/header.php');
    require_once(__DIR__ . '/../_inc/navbar.php');
?>

<h3 style="color: red">Show event</h3>

<?php
    session_start();
    if (!empty($_SESSION['message'])) {
        echo '<div style="color: green; padding-top: 10px; padding-bottom: 10px;"><b>! ! !' . $_SESSION['message'] . '! ! !</></div>';
        unset($_SESSION['message']);
    }
?>

<table>
    <tr>
        <td>Id</td>
        <td><?= $data['id']?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?= $data['name']?></td>
    </tr>
    <tr>
        <td>City</td>
        <td><?= $data['city']?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?= $data['address']?></td>
    </tr>
    <tr>
        <td>Date</td>
        <td><?= $data['date']?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?= $data['description']?></td>
    </tr>
    <tr>
        <td>Created at</td>
        <td><?= $data['created_at']?></td>
    </tr>
    <tr>
        <td>Updated at</td>
        <td><?= $data['updated_at']?></td>
    </tr>
</table>

<?php 
    require_once(__DIR__ . '/../_inc/footer.php');
?>