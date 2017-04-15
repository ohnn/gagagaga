<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] == 1):
?>

<h2 class="text-center">Voit selata aikoja kalenterista.</h2>
<div class="container">
    <?php
    //require_once 'jeccu/AvailableTimes.php';
    ?>
    
    <?php
    include 'test.php';
    ?>
</div>

<?php else: ?>
<h1>Sinulla ei ole oikeutta nähdä tätä sivua</h1>
<?php endif; ?>