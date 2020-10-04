<?php
  require_once __DIR__ . '/../_inc/header.php';
  require_once __DIR__ . '/../_inc/navbar.php';
?>

<h3 style="color: red">Edit member</h3>

<?= (isset($errors['error'])) ? '<br><div style="color: red">' . $errors['error'] . '</div><br><br><br>' : ''; ?>

<form action="<?= '/event/' . $data['event_id'] . '/member/' . $data['id']?>" method="post">
  <?= (isset($errors['first_name'])) ? ('<div style="color: red">' . str_replace('|', '<br>', $errors['first_name'])) . '</div>' : ''; ?>
  <span>First name: </span><br>
  <input type="text" name="first_name" value="<?= (isset($data['first_name'])) ? $data['first_name'] : ''; ?>">
  <br><br>

  <?= (isset($errors['last_name'])) ? ('<div style="color: red">' . str_replace('|', '<br>', $errors['last_name'])) . '</div>' : ''; ?>
  <span>Last name: </span><br>
  <input type="text" name="last_name" value="<?= (isset($data['last_name'])) ? $data['last_name'] : ''; ?>">
  <br><br>

  <?= (isset($errors['email'])) ? ('<div style="color: red">' . str_replace('|', '<br>', $errors['email'])) . '</div>' : ''; ?>
  <span>Email: </span><br>
  <input type="text" name="email" value="<?= (isset($data['email'])) ? $data['email'] : ''; ?>">
  <br><br>

  <input type="hidden" name="id" value="<?= $data['id']?>">
  <input type="hidden" name="event_id" value="<?= $data['event_id']?>">
  <input type="hidden" name="_method" value="put">
  <input type="submit" value="Submit">
</form>

<?php
  require_once __DIR__ . '/../_inc/footer.php';
?>