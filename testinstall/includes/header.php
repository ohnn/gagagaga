<?php if ( !$logged ): ?>   
    <header class="container-fluid jumbotron text-center">
        
        <h1>HENE N SIVU</h1>
        
    </header>
<?php else: ?>
    <header class="container-fluid text-center">
        
        <h1><?php echo 'Olet kirjautunut sisään käyttäjänä ' . $_SESSION['username']; ?></h1>
        
        
        
    </header>
<?php endif; ?>    
