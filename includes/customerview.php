<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] == 1):
?>

<h2 class="text-center">Voit selata aikoja kalenterista.</h2>
<div class="container">
    <?php
    require 'jeccu/AvailableTimes.php';
    
    $times = new AvailableTimes();
    $times->printTimes('2017-04-8');
    ?>
    
    <?php
    include 'test.php';
    ?>
</div>

<?php else: ?>
<h1>Sinulla ei ole oikeutta nähdä tätä sivua</h1>
<?php endif; ?>