<div class="container add_doctor">  
    <h2>Luo käyttäjä</h2>
    <form id="add_doctor" action="jeccu/userAdd_2.php" method="post">
        <label for="inputName1" class="sr-only">Sisäänkirjautumistunnus</label>
        <input type="text" name="inputName1" id="inputName1" class="form-control" placeholder="Käyttäjätunnus" required autofocus>
        
        <label for="firstName" class="sr-only">Etunimi</label>
        <input type="text" name="firstName" id="firstName" class="form-control inline" placeholder="Etunimi" required autofocus>
        
        <label for="lastName" class="sr-only">Sukunimi</label>
        <input type="text" name="lastName" id="lastName" class="form-control inline" placeholder="Sukunimi" required autofocus>
        
        <label for="phoneNumber" class="sr-only">Puhelinnumero</label>
        <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" placeholder="Puhelinnumero" required autofocus>
        
        <label for="email" class="sr-only">Sähköposti</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Sähköposti" required autofocus>
        
        <label for="registerPassword" class="sr-only">Salasana</label>
        <input type="password" name="registerPassword" id="registerPassword" class="form-control inline" placeholder="Salasana" required>
        
        <label for="registerPassword1" class="sr-only">Salasana uudestaan</label>
        <input type="password" name="registerPassword1" id="registerPassword1" class="form-control lastForm inline" placeholder="Salasana uudelleen" required>
 
        <label for="erikoisalaID">Erikoisala ja toimipiste</label>
        <select class="form-control inline" id="erikoisalaID" name="erikoisalaID" required>
            <option value="1">Neurokirurgia</option>
            <option value="2">Sydän</option>
            <option value="3">Keuhkot</option>
            <option value="4">Vatsa</option>
            <option value="5">Maksa</option>
        </select>
        
        <select class="form-control lastForm inline" id="toimipisteID" name="toimipisteID" required>
            <option value="1">Lappeenranta</option>
            <option value="2">Taipalsaari</option>
        </select>
        
        <button class="btn btn-lg btn-primary btn-block userAdd" type="button" id="userAdd">Luo lääkärikäyttäjä</button>
    </form>
</div>