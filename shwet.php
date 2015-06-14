<?php include 'header.php';?>

<div class="container">

      <div class="row-fluid">
        <div class="row-fluid">
  <div class="span12">
      <div class="hero-unit">
        <h1>Bienvenue sur le nouveau Shwet.</h1>
        <p>Shwet IS BACK ! 
        Pour consulter les documents d'une UV ou pour donner les tiens, tape son nom dans la barre de recherche (par exemple, "MT23").</p>
      </div>
       <form id="big-search-uv-form" class="form-search navbar-search" method="GET" action="uv.php">
              <div class="input-append">
                <input style="width: 1000px;" name="u" autocomplete="on" id="big-search-uv-name" class="search-query span2" type="text" placeholder="Rechercher une UV">
                <button type="submit" class="btn btn-primary">
                  <img height="20" width="20" src="img/loupe.ico"></a>
                </button>
              </div>
        </form>
	</div>
</div>

  </body>
</html>
