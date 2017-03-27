<?php 
require 'jeccu/start_session.php';
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="js/jquery_language.js"></script>
        <title>index</title>
    </head>
    <body>
        <!-- navbar -->
        <?php
        include 'includes/navbar.php';
        ?>
        
        <!-- header -->
        <?php
        include 'includes/header.php';
        ?>
        
        <!-- alertit danger/success -->
        <?php if (isset($_GET["error"])):?>
        <div class="container">
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Voi että :)</strong> <?php echo urldecode($_GET["error"]); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if (isset($_GET["success"])):?>
        <div class="container">
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Hyvin meni.</strong> <?php echo urldecode($_GET["success"]); ?>
            </div>
        </div>
        <?php endif; ?>
        <!-- /alertit -->
        
        <!-- näkymä tilasta riippuen -->
        <?php
        switch ( $role ) {
            case 1:
                include 'includes/customerview.php';
                break;
            case 2:
                include 'includes/doctor_addtimesform.php';
                break;
            case 3:
                include 'includes/addUser_selection.php';
                include 'includes/addUser_doctor.php';
                include 'includes/addUser_admin.php';
                break;
            default:
                include 'includes/login.php';
                include 'includes/register.php';
        }
        ?>

    <br><br><br>
    
    <div class="container">
    <?php
    include 'test.php';
    ?>
    </div>

        <script src="js/main.js"></script>
    </body>
</html>