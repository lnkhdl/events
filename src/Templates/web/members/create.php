<?php
  require_once __DIR__ . '/../_inc/header.php';
  require_once __DIR__ . '/../_inc/navbar.php';
?>

<main>
  <section class="form">
    <h2>Create a member for event <?= $data['event_name']; ?></h2>

    <?= (isset($errors['error'])) ? '<div class="error-msg">' . $errors['error'] . '</div>' : ''; ?>

    <form action="<?= '/event/' . $data['event_id'] . '/member/add'?>" method="post" name="createMemberForm">
      <label for="name">First name *</label>
      <?= (isset($errors['first_name'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['first_name'])) . '</div>' : ''; ?>
      <input type="text" name="first_name" value="<?= (isset($data['first_name'])) ? $data['first_name'] : ''; ?>">

      <label for="name">Last name *</label>
      <?= (isset($errors['last_name'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['last_name'])) . '</div>' : ''; ?>
      <input type="text" name="last_name" value="<?= (isset($data['last_name'])) ? $data['last_name'] : ''; ?>">

      <label for="name">Email *</label>
      <?= (isset($errors['email'])) ? ('<div class="form-error">' . str_replace('|', '<br>', $errors['email'])) . '</div>' : ''; ?>
      <input type="text" name="email" value="<?= (isset($data['email'])) ? $data['email'] : ''; ?>">

      <input class="main-btn" type="submit" value="Add member">
      <p class="note">* indicates a required field</p>
    </form>
  </section>
</main>


<?php
  require_once __DIR__ . '/../_inc/footer.php';
?>