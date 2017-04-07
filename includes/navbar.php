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