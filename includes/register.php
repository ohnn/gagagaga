<div class="container">

  <form class="form-signup" action="jeccu/userAdd.php" method="post">
    <h2 class="form-signup-heading">Luo käyttäjä</h2>
    
    <label for="inputName1" class="sr-only">Sisäänkirjautumistunnus</label>
    <input type="text" name="inputName1" id="inputName1" class="form-control" placeholder="Käyttäjätunnus" required autofocus>
    
    <label for="firstName" class="sr-only">Etunimi</label>
    <input type="text" name="firstName" id="firstName" class="form-control inline" placeholder="Etunimi" required autofocus>
    
    <label for="lastName" class="sr-only">Sukunimi</label>
    <input type="text" name="lastName" id="lastName" class="form-control inline" placeholder="Sukunimi" required autofocus>
    
    <label for="email" class="sr-only">Sähköposti</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Sähköposti" required autofocus>
    
    <label for="address" class="sr-only">Lähiosoite</label>
    <input type="text" name="address" id="address" class="form-control" placeholder="Lähiosoite" required autofocus>
    
    <label for="postalCode" class="sr-only">Postinumero</label>
    <input type="text" name="postalCode" id="postalCode" class="form-control" placeholder="Postinumero" required autofocus>
    
    <label for="postOffice" class="sr-only">Postitoimipaikka</label>
    <input type="text" name="postOffice" id="postOffice" class="form-control" placeholder="Postitoimipaikka" required autofocus>
    
    <label for="phoneNumber" class="sr-only">Puhelinnumero</label>
    <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" placeholder="Puhelinnumero" required autofocus>
    
    <label for="registerPassword" class="sr-only">Salasana</label>
    <input type="password" name="registerPassword" id="registerPassword" class="form-control inline" placeholder="Salasana" required>
    
    <label for="registerPassword" class="sr-only">Salasana uudestaan</label>
    <input type="password" name="registerPassword1" id="registerPassword1" class="form-control lastForm inline" placeholder="Salasana uudelleen" required>
    
    <button class="btn btn-lg btn-primary btn-block" type="button" id="userAdd">Luo käyttäjä</button>
    <button class="btn btn-lg btn-primary btn-block backToLogin" type="button">Minulla on jo käyttäjä</button>
  </form>

</div>