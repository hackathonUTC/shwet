<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Shwet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Nicolas Szewe">
    <meta name="author" content="Mewen Michel">

    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/table-colors.css" type="text/css" />
    <link rel="stylesheet" href="css/shwet-css.css" type="text/css" />

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>
    <script src="shwet.js"></script>


  </head>


  <body>
    <div id="holder">
      <!-- Barre de menu -->
      <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse"></a>
            <a class="brand" href="?">
              <img height="50" width="112" src="img/logo.png">
            </a>

            <!-- Champs de recherche -->
            <form id="search-uv-form" class="form-search navbar-search" method="GET" action="?page=uv">
              <div class="input-append">
                <input type="hidden" name="page" value="uv">
                <input style="width: 150px;" name="u" autocomplete="on"
                  id="search-uv-name" class="search-query span2" type="text" placeholder="Rechercher une UV">
                <button type="submit" class="btn btn-primary search-uv-button">
                  <img height="20" width="20" src="img/loupe.ico">
                </button>
              </div>
            </form>

            <!-- Partie de droite -->
            <div class="nav-collapse collapse navbar-responsive-collapse">
              <ul class="nav pull-right">
                <li class="dropdown">
                  <a class= "dropdown-toggle" href="?page=contact">Nous contacter</a>
                </li>
                <li class="dropdown">
                  <a class= "dropdown-toggle" href="#" onclick="javascript:alert('Fonctionnalité en cours de développement')">Envoyer un fichier</a>
                </li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    UVs
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="nav-header">Branche</li>
                    <li><a href="?page=branche&amp;b=GB">GB</a></li>
                    <li><a href="?page=branche&amp;b=GI">GI</a></li>
                    <li><a href="?page=branche&amp;b=GM">GM</a></li>
                    <li><a href="?page=branche&amp;b=GP">GP</a></li>
                    <li><a href="?page=branche&amp;b=GSM">GSM</a></li>
                    <li><a href="?page=branche&amp;b=GSU">GSU</a></li>
                    <li class="nav-header">Communes</li>
                    <li><a href="?page=branche&amp;b=TC">TC</a></li>
                    <li><a href="?page=branche&amp;b=TSH">TSH</a></li>
                    <li class="nav-header">Toutes</li>
                    <li><a href="?page=branche&amp;b=all">Ordre Alphabétique</a></li>
                  </ul>
                </li>
  		          <li class="divider-vertical"></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user icon-white"></i> 
                    <span><?php echo $_SESSION['user']; ?></span>
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                      <li>
                        <a href="?page=logout">
                          <i class="icon-off"></i>
                          Déconnexion
                        </a>
                      </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container main-container">