<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Valikko <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <?php switch($role): 
        // asiakas
        case 1:         /* Jokaisella näkymällä oma luokkansa, jonka perusteella näytetään / ei näytetä */ ?>
        <li><a href="#" onclick="loadAndChange('.customerTimes', '.reserveTimeElement', 'test.php')">Ajanvaraus</a></li>
        <li><a href="#" onclick="loadAndChange('.reserveTimeElement', '.customerTimes', 'includes/customerTimes.php')">Varatut ajat</a></li>
        <?php break; ?>
        <?php 
        // lääkäri
        case 2: ?>
        <li><a href="#" onclick="loadAndChange('.customerTimes', '.doctor-AddTimesContainer', 'includes/doctorView.php')">Lisää työaikoja</a></li>
        <li><a href="#" onclick="loadAndChange('.doctor-AddTimesContainer', '.customerTimes', 'includes/doctorTimes.php')">Minulle varatut ajat</a></li>
        <?php break; ?>
        <?php endswitch; ?>
    </ul>
</li>