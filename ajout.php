<?php
session_start();
include 'header.php';
?>

<div class="container main-container">

      <div class="row-fluid">
        <div class="row-fluid">
  <div class="span12">
      <div class="hero-unit">
        <h3>Ajout d'un fichier</h3>
      </div>
        <form id="big-search-uv-form" class="form-search navbar-search" enctype="multipart/form-data" method="POST"
         action="javascript:dataLayer.push({'event' : 'formulaireEnvoi'})">
              <div class="input-append">
                <input style="width: 1000px;" name="u" autocomplete="on" id="big-search-uv-name" class="search-query span2" type="text" placeholder="Rechercher une UV">
              </div>
              <br>
            <label for="selectType">Type :</label> <select id="selectType" required>  					
              		<option value="TD">TD</option>
  					<option value="TP">TP</option>
  					<option value="annales">Annales</option>
  					<option value="autres">autres</option>
			</select><br>
			<label for="nomfichier">Nom Fichier :</label> <input required id ="nomfichier" type ="text"><br>
            <label for="note">Note :</label><input id = "note" type="number" step="0.25" min="0" max="20"><br>
			<label for="semestre">Semestre :</label><input id ="semestre" required type ="text"><br>
			<label for="commentaire">Commentaire :</label><input id ="commentaire" type ="text"><br>
			<input type="file" name="fichier" required/>
			<input type="hidden" name="MAX_FILE_SIZE" value="5008576" />
			<input TYPE="submit" NAME="nom" value=" Envoyer ">


        </form>
        <div id="uploadProgress">
	<h1>Chargement...</h1>
	<div id="uploadProgressBar" class="progressBar"><span style="width: 0%"></span></div>
	<p id="uploadProgressPercent"></p>
</div><!--uploadProgress-->

<div id="uploadResult">
	<h1>Résultat</h1>
	<div></div>
</div><!--uploadResult-->

	</div>
</div>

  </body>
</html>
