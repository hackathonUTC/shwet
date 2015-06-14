<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Accueil - Shwet
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Nicolas Szewe">

    <!-- Les styles -->
    <style type="text/css">
      body {
      padding-top: 60px;
      padding-bottom: 40px;
    }
    </style>
    
          <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
      <link rel="stylesheet" href="css/table-colors.css" type="text/css" />
      <link rel="stylesheet" href="css/shwet-css.css" type="text/css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>


  </head>
  <!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WN57HQ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WN57HQ');</script>
<!-- End Google Tag Manager -->

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
          </a>
                                <a style="padding-top: 10px; padding-bottom: 10px;" class="brand" href="shwet.php"><img height="100" width="100" src="img/shwet.jpeg"></a>
           <form id="search-uv-form" class="form-search navbar-search" method="GET" action="uv.php">
              <div class="input-append">
                <input style="width: 150px;" name="u" autocomplete="on
                " id="search-uv-name" class="search-query span2" type="text" placeholder="Rechercher une UV">
                <button type="submit" class="btn btn-primary">
                  <img height="20" width="20" src="img/loupe.ico"></a>
                </button>
              </div>
        </form>
          <div class="nav-collapse collapse navbar-responsive-collapse">
            <ul class="nav pull-right">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  UVs
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="nav-header">Branche</li>
                  <li><a href="branche.php?b=GB">GB</a></li>
                  <li><a href="branche.php?b=GI">GI</a></li>
                  <li><a href="branche.php?b=GM">GM</a></li>
                  <li><a href="branche.php?b=GP">GP</a></li>
                  <li><a href="branche.php?b=GSM">GSM</a></li>
                  <li><a href="branche.php?b=GSU">GSU</a></li>
                  <li class="nav-header">Communes</li>
                  <li><a href="branche.php?b=TC">TC</a></li>
                  <li><a href="branche.php?b=TSH">TSH</a></li>
                  <li class="nav-header">Toutes</li>
                  <li><a href="branche.php?b=all">Ordre Alphabétique</a></li>
                </ul>
              </li>
              </li>
              <?php
session_start();
require_once 'CAS.class.php';
if (!isset($_SESSION['user']))
{
	$user = CAS::authenticate();
	if ($user != -1) $_SESSION['user'] = $user;
}
else CAS::login();
?>

           

		<li class="divider-vertical"></li>
          <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="icon-user icon-white"></i> 
                                      <span><?php $user ?></span>
                                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="logout.php"><i class="icon-off"></i> Déconnexion</a></li>
                                  </ul>
              </li>
     </ul>
          </div>
        
          
        </div>
      </div>
    </div>
