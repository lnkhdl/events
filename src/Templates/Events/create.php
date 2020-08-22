<?php
require_once(__DIR__ . '/../_inc/header.php');
require_once(__DIR__ . '/../_inc/navbar.php');
?>

<h3 style="color: green">Create event</h3>

<form action="/event/add" method="post">
  <?= (isset($errors['event_name'])) ? ('<div style="color: red">' . str_replace('|', '<br>', $errors['event_name'])) . '</div>': ''; ?>
  <span>Event name: </span><input type="text" name="event_name" value="<?= (isset($data['event_name'])) ? $data['event_name'] : ''; ?>">
  <br>
  <?= (isset($errors['event_city'])) ? ('<div style="color: red">' . str_replace('|', '<br>', $errors['event_city'])) . '</div>': ''; ?>
  <span>Event city: </span><input type="text" name="event_city" value="<?= (isset($data['event_city'])) ? $data['event_city'] : ''; ?>">
  <br>
  <input type="submit" value="Submit">
</form>


<?php
require_once(__DIR__ . '/../_inc/footer.php');
?>