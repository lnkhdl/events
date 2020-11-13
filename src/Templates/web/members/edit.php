<?php
  require_once __DIR__ . '/../_inc/header.php';
  require_once __DIR__ . '/../_inc/navbar.php';
?>

<main>
  <section class="form">
    <h2>Edit member</h2>

    <?= (isset($errors['error'])) ? '<div class="error-msg">' . $errors['error'] . '</div>' : ''; ?>

    <form action="<?= '/event/' . $data['event_id'] . '/member/' . $data['id']?>" method="post">
      <label for="name">First name *</label>
      <?= (isset($errors['first_name'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['first_name'])) . '</div>' : ''; ?>
      <input type="text" name="first_name" value="<?= (isset($data['first_name'])) ? $data['first_name'] : ''; ?>">

      <label for="name">Last name *</label>
      <?= (isset($errors['last_name'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['last_name'])) . '</div>' : ''; ?>
      <input type="text" name="last_name" value="<?= (isset($data['last_name'])) ? $data['last_name'] : ''; ?>">

      <label for="name">Email *</label>
      <?= (isset($errors['email'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['email'])) . '</div>' : ''; ?>
      <input type="text" name="email" value="<?= (isset($data['email'])) ? $data['email'] : ''; ?>">

      <input type="hidden" name="id" value="<?= $data['id']?>">
      <input type="hidden" name="event_id" value="<?= $data['event_id']?>">
      <input type="hidden" name="_method" value="put">
      <input class="main-btn" type="submit" value="Update member">
      <p class="note">* indicates a required field</p>
    </form>
  </section>
</main>


<?php
  require_once __DIR__ . '/../_inc/footer.php';
?>