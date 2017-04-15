<!--
<nav class="navbar navbar-inverse" id="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">HENE N  SIVU</a>
    </div>
    <ul class="nav navbar-nav navbar-right" id="navbarCollapse">
        <?php if (!$logged): ?>
          <li><a href="#" class="registerButton"><span class="glyphicon glyphicon-user"></span> Luo käyttäjä</a></li>
          <li><a href="#" class="backToLogin"><span class="glyphicon glyphicon-log-in"></span> Kirjaudu sisään</a></li>
        <?php else: ?>
          <li><a href="jeccu/logout.php"><span class="glyphicon glyphicon-log-out"></span> Kirjaudu ulos</a></li>
        <?php endif; ?>
    </ul>
  </div>
</nav>
-->
<nav class="navbar navbar-inverse" id="navbar">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">HENE N SIVU</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        
        <!-- kirjautumishommat -->
        <?php if (!$logged): ?>
          <li><a href="#" class="registerButton"><span class="glyphicon glyphicon-user"></span> Luo käyttäjä</a></li>
          <li><a href="#" class="backToLogin"><span class="glyphicon glyphicon-log-in"></span> Kirjaudu sisään</a></li>
        <?php else: ?>
          <li><a href="jeccu/logout.php"><span class="glyphicon glyphicon-log-out"></span> Kirjaudu ulos</a></li>
        <?php endif; ?>
        <!-- /kirjautumishommat -->
        
        <!-- dropdown -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        <!-- /dropdown -->
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>