<div class="container">

  <form class="form-signin" action="jeccu/userLogin.php" method="post">
    <h2 class="form-signin-heading">Kirjaudu sisään</h2>
    <label for="inputName" class="sr-only">Sisäänkirjautumistunnus</label>
    <input type="text" id="inputName" name="inputName" class="form-control" placeholder="Sisäänkirjautumistunnus" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control lastForm" placeholder="Salasana" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Kirjaudu sisään</button>
    <button class="btn btn-lg btn-primary btn-block registerButton" type="button">Luo uusi käyttäjä</button>
  </form>
  
</div>