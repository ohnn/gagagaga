<nav class="navbar navbar-inverse" id="navbar">
  <div class="container-fluid">
    <!-- group brand and toggle -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">HENE N SIVU</a>
    </div>

    <!-- collect content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        
        <!-- login-/out/create/ -->
        <?php if (!$logged): ?> 
          <li><a href="#" class="registerButton"><span class="glyphicon glyphicon-user"></span> Luo käyttäjä</a></li>
          <li><a href="#" class="backToLogin"><span class="glyphicon glyphicon-log-in"></span> Kirjaudu sisään</a></li>
        <?php else: ?>
          <li><a href="jeccu/logout.php"><span class="glyphicon glyphicon-log-out"></span> Kirjaudu ulos</a></li>
        <?php endif; ?>
        <!-- /login-/out/create -->
        
        <!-- dropdown -->
        <?php
        if ($logged && ($role == 1 || $role == 2)) {
          include 'dropdown.php'; 
        }
        ?>
        <!-- /dropdown -->
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>