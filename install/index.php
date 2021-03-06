<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="view/css/styles.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <title>index</title>
    </head>
    <body>
        <?php include 'view/form.php'; ?>
        <br><br>
        <?php // include 'view/userForm.php'; ?>
        <script>
        $('#button-install').click(function() {
            var form = $(this).parent();
            var username = form.find('#inputName1').val();
            var pw1 = form.find('#registerPassword').val();
            var pw2 = form.find('#registerPassword1').val();
            if (/[^a-zA-Z0-9]/.test(username)) {
                alert('Ainoastaan kirjaimet A-Z ja numerot 0-9 ovat sallittuja.');
                return;
            }
            if (username.length < 4 || username.length > 18) {
                alert('Käyttäjänimen tulee olla vähintään 4 merkkiä ja korkeintaan 18 merkkiä pitkä');
                return;
            }
            if (pw1 == pw2 && pw1.length >= 4) {
                form.submit();
            }
            else {
                alert('Salasanat eivät täsmää tai salasana ei ole tarpeeksi pitkä (salasanan tulee olla vähintään neljä merkkiä pitkä).');
                return;
            }
        });
    </script>
    </body>
</html>