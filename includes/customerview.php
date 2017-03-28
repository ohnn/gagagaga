<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] == 1):
?>
<h2 class="text-center">Olet kirjautunut sisään asiakkaana.</h2>

<div class="container">

<h2>terve</h2>

</div>
<?php else: ?>
<h1>Sinulla ei ole oikeutta nähdä tätä sivua</h1>
<?php endif; ?>