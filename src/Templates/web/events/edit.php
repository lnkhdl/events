<?php
  require_once __DIR__ . '/../_inc/header.php';
  require_once __DIR__ . '/../_inc/navbar.php';
?>

<main>
  <section class="form">
    <h2>Edit event</h2>

    <?= (isset($errors['error'])) ? '<div class="error-msg">' . $errors['error'] . '</div>' : ''; ?>

    <form action="<?= '/event/'  . $data['id']?>" method="post" name="editEventForm">
      <label for="name">Event name *</label>
      <?= (isset($errors['name'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['name'])) . '</div>' : ''; ?>
      <input type="text" name="name" value="<?= (isset($data['name'])) ? $data['name'] : ''; ?>">

      <label for="city">City *</label>
      <?= (isset($errors['city'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['city'])) . '</div>' : ''; ?>
      <input type="text" name="city" value="<?= (isset($data['city'])) ? $data['city'] : ''; ?>">

      <label for="address">Address *</label>
      <?= (isset($errors['address'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['address'])) . '</div>' : ''; ?>
      <input type="text" name="address" value="<?= (isset($data['address'])) ? $data['address'] : ''; ?>">

      <label for="date">Date and time of the event *</label>
      <?= (isset($errors['date'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['date'])) . '</div>' : ''; ?>
      <input type="datetime-local" name="date" value="<?= (isset($data['date'])) ? $data['date'] : ''; ?>">

      <label for="description">Description</label>
      <?= (isset($errors['description'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['description'])) . '</div>' : ''; ?>
      <textarea rows="4" cols="50" name="description"><?= (isset($data['description'])) ? $data['description'] : ''; ?></textarea>

      <input type="hidden" name="_method" value="put">
      <input class="main-btn" type="submit" value="Update event">
      <p class="note">* indicates a required field</p>
    </form>
  </section>
</main>


<?php
  require_once __DIR__ . '/../_inc/footer.php';
?>