<?php
    require_once(__DIR__ . '/../_inc/header.php');
    require_once(__DIR__ . '/../_inc/navbar.php');
?>

<h3 style="color: red">Events - Index</h3>

<?php foreach ($data as $d): ?>
    <hr>
    <table>
        <tr>
            <td>Id</td>
            <td><?= $d['id']?></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><?= $d['name']?></td>
        </tr>
        <tr>
            <td>City</td>
            <td><?= $d['city']?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><?= $d['address']?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td><?= $d['date']?></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><?= $d['description']?></td>
        </tr>
        <tr>
            <td>Created at</td>
            <td><?= $d['created_at']?></td>
        </tr>
        <tr>
            <td>Updated at</td>
            <td><?= $d['updated_at']?></td>
        </tr>
    </table>
<?php endforeach ?>

<?php 
    require_once(__DIR__ . '/../_inc/footer.php');
?>