<div class="container add_admin"> 
    <h2>Tietokannat</h2>
    <h3>Varmista, että olet luonut kaksi tietokantaa sekä käyttäjät, joilla on näihin tietokantoihin täydet oikeudet.</h3>
    <form id="form-install-database" action="action/createstuff.php" method="post">
        
        <h2>Host</h2>
        <label for="hostname" class="sr-only">host</label>
        <input type="text" name="hostname" id="hostname" class="form-control" placeholder="Host" required autofocus>
        
        <br><br>
        
        <h2>Ensimmäinen tietokanta (ajanvaraussysteemi)</h2>
        <label for="_databasename" class="sr-only">Ensimmäisen tietokannan nimi</label>
        <input type="text" name="_databasename" id="_databasename" class="form-control" placeholder="Ensimmäisen tietokannan nimi" required autofocus>
        
        <label for="_databaseuser" class="sr-only">Käyttäjä</label>
        <input type="text" name="_databaseuser" id="_databaseuser" class="form-control inline align-left" placeholder="Käyttäjä" required autofocus>
        
        <label for="_databasepw" class="sr-only">Salasana</label>
        <input type="password" name="_databasepw" id="_databasepw" class="form-control inline align-right" placeholder="Salasana" required>
        
        <br><br>
        
        <h2>Toinen tietokanta (käyttäjät)</h2>
        <label for="databasename" class="sr-only">Toisen tietokannan nimi</label>
        <input type="text" name="databasename" id="databasename" class="form-control" placeholder="Toisen tietokannan nimi" required autofocus>
        
        <label for="databaseuser" class="sr-only">Käyttäjä</label>
        <input type="text" name="databaseuser" id="databaseuser" class="form-control inline align-left" placeholder="Käyttäjä" required autofocus>
        
        <label for="databasepw" class="sr-only">Salasana</label>
        <input type="password" name="databasepw" id="databasepw" class="form-control inline align-right" placeholder="Salasana" required>
        
        <br><br>
        
        <h2>Luo admin-käyttäjä</h2>
        <label for="inputName1" class="sr-only">Sisäänkirjautumistunnus</label>
        <input type="text" name="inputName1" id="inputName1" class="form-control" placeholder="Käyttäjätunnus" required autofocus>
        
        <label for="registerPassword" class="sr-only">Salasana</label>
        <input type="password" name="registerPassword" id="registerPassword" class="form-control inline align-left" placeholder="Salasana" required>
        
        <label for="registerPassword1" class="sr-only">Salasana uudestaan</label>
        <input type="password" name="registerPassword1" id="registerPassword1" class="form-control lastForm inline align-right" placeholder="Salasana uudelleen" required>
        
        <button class="btn btn-lg btn-primary" type="button" id="button-install">Asenna</button>
    </form>
</div>