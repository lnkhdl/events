<?php
  require_once __DIR__ . '/../_inc/header.php';
  require_once __DIR__ . '/../_inc/navbar.php';
?>

<h3 style="color: red">Edit event</h3>

<?= (isset($errors['error'])) ? '<br><div style="color: red">' . $errors['error'] . '</div><br><br><br>' : ''; ?>

<form action="<?= '/event/'  . $data['id']?>" method="post">
  <?= (isset($errors['name'])) ? ('<div style="color: red">' . str_replace('|', '<br>', $errors['name'])) . '</div>' : ''; ?>
  <span>Event name: </span><br>
  <input type="text" name="name" value="<?= (isset($data['name'])) ? $data['name'] : ''; ?>">
  <br><br>

  <?= (isset($errors['city'])) ? ('<div style="color: red">' . str_replace('|', '<br>', $errors['city'])) . '</div>' : ''; ?>
  <span>City: </span><br>
  <input type="text" name="city" value="<?= (isset($data['city'])) ? $data['city'] : ''; ?>">
  <br><br>

  <?= (isset($errors['address'])) ? ('<div style="color: red">' . str_replace('|', '<br>', $errors['address'])) . '</div>' : ''; ?>
  <span>Address: </span><br>
  <input type="text" name="address" value="<?= (isset($data['address'])) ? $data['address'] : ''; ?>">
  <br><br>

  <?= (isset($errors['date'])) ? ('<div style="color: red">' . str_replace('|', '<br>', $errors['date'])) . '</div>' : ''; ?>
  <span>Date and time of the event (for example 31-01-2000 14:00): </span><br>
  <input type="text" name="date" value="<?= (isset($data['date'])) ? $data['date'] : ''; ?>">
  <br><br>

  <?= (isset($errors['description'])) ? ('<div style="color: red">' . str_replace('|', '<br>', $errors['description'])) . '</div>' : ''; ?>
  <span>Description: </span><br>
  <textarea rows="4" cols="50" name="description"><?= (isset($data['description'])) ? $data['description'] : ''; ?></textarea>
  <br><br>

  <input type="hidden" name="id" value="<?= $data['id']?>">
  <input type="hidden" name="_method" value="put">
  <input type="submit" value="Submit">
</form>

<?php
  require_once __DIR__ . '/../_inc/footer.php';
?>