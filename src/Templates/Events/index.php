<?php
    require_once(__DIR__ . '/../_inc/header.php');
    require_once(__DIR__ . '/../_inc/navbar.php');
?>

<h3 style="color: red">Events - Index</h3>

<?php foreach ($data as $d): ?>
    <p><?= $d ?></p>
<?php endforeach ?>

<?php 
    require_once(__DIR__ . '/../_inc/footer.php');
?>