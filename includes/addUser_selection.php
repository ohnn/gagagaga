<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] == 3):
?>
<div class="container">
  <form class="form-select" id="form-select">
    <h2 class="form-signup-heading">Valitse ensin, minkälaisen käyttäjän haluat luoda</h2>
    <label for="role">Valitse rooli</label>
      <select class="form-control" id="role" name="role">
        <option value="0"></option>
        <option value="2">Lääkäri</option>
        <option value="3">Admin</option>
      </select>
  </form>
  <hr>
</div>
<?php else: ?>
<h1>Sinulla ei ole oikeutta nähdä tätä sivua</h1>
<?php endif; ?>