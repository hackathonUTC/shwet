<?php
session_start();
include 'header.php';
?>

<br><br>
<div class="container main-container">
<div class="row-fluid">
	<div class="span12">
		<ul class="nav nav-tabs">
                  <li id="GBSelecteur"><a  href="branche.php?b=GB">GB</a></li>
                  <li id="GISelecteur"><a  href="branche.php?b=GI">GI</a></li>
                  <li id="GMSelecteur"><a  href="branche.php?b=GM">GM</a></li>
                  <li id="GPSelecteur"><a  href="branche.php?b=GP">GP</a></li>
                  <li id="GSMSelecteur"><a  href="branche.php?b=GSM">GSM</a></li>
                  <li id="GSUSelecteur"><a  href="branche.php?b=GSU">GSU</a></li>
                  <li id="TCSelecteur"><a  href="branche.php?b=TC">TC</a></li>
                  <li id="TSHSelecteur"><a  href="branche.php?b=TSH">TSH</a></li>
                  <li id="ALLSelecteur"><a  href="branche.php?b=all">Toutes</a></li>
		</ul>
	</div>
</div>


<div class="page-header text-center">
	<div class="row-fluid">
		<div class="offset2 span8">
	<div id="title"><h1></h1></div>	
	<h2> Toutes les UVs <small>Ordre Alphabétique</small></h2>
		</div>
	</div>
</div>

<div id="list-container" class="row-fluid">
</div>
</div>
    </div>
  </body>
</html>
