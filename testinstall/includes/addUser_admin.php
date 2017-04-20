<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] == 3):
?>
<div class="container add_admin"> 
    <h2>Luo käyttäjä</h2>
    <form id="add_admin" action="jeccu/userAdd_3.php" method="post">
        <label for="inputName1" class="sr-only">Sisäänkirjautumistunnus</label>
        <input type="text" name="inputName1" id="inputName1" class="form-control" placeholder="Käyttäjätunnus" required autofocus>
        
        <label for="registerPassword" class="sr-only">Salasana</label>
        <input type="password" name="registerPassword" id="registerPassword" class="form-control inline" placeholder="Salasana" required>
        
        <label for="registerPassword" class="sr-only">Salasana uudestaan</label>
        <input type="password" name="registerPassword1" id="registerPassword1" class="form-control lastForm inline" placeholder="Salasana uudelleen" required>
        
        <button class="btn btn-lg btn-primary btn-block userAdd" type="button">Luo adminkäyttäjä</button>
    </form>
</div>
<?php else: ?>
<h1>Sinulla ei ole oikeutta nähdä tätä sivua</h1>
<?php endif; ?>