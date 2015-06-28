<div class="choiceConteneur">
  <div class="flexItem">
    <div class="choiceItem">
      <h3>Ajout d'un fichier</h3>
    </div>
  </div>


  <div class="flexItem">
    <div class="choiceItem active">
      <h3>Ajout d'un lien vers un document externe</h3>
    </div>
  </div>
  <div class="flexItem" title="Fonctionnalité en préparation :)">
    <div class="choiceItem disabled">
      <h3>Création d'un Pad</h3>
    </div>
  </div>
</div>

<div class="choiceConteneur">
    <div class="flexItem">
        <!-- Formulaire -->
        <!-- <form id="big-search-uv-form" class="form-search navbar-search" enctype="multipart/form-data" method="POST" action="upload.php"> -->
      <div class="formConteneur">
        <form enctype="multipart/form-data" method="POST" action="?page=upload" id="formFichier">
          <input type="hidden" name="submitted_doc" value="file" />
          <input type="hidden" name="form" value="true" />
          <div class="form-group">
            <!-- <div class="input-append"> -->
              <!-- <input style="width: 1000px;" name="u" autocomplete="on" id="big-search-uv-name" class="search-query span2"  type="text" placeholder="Rechercher une UV"> -->
              <input name="u" autocomplete="on" id="big-search-uv-name" class="form-control"  type="text" placeholder="Rechercher une UV">
            <!-- </div> -->
          </div>
            <div class="form-group">
              
              <select name="selectType" id="selectType" class="form-control" required>  					
                <option value="TD">TD</option>
                <option value="TP">TP</option>
                <option value="Annale">Annale</option>
                <option value="Rapport">Rapport ou projet</option>
                <option value="Poster">Poster</option>
                <option value="Autres">Autres</option>
        			</select>
            </div>
          <div class="form-group">
      			 <input required name="nomfichier"  class="form-control" id ="nomfichier" type ="text" placeholder="Nom du fichier"><br>
          </div>
          <div class="form-group">
            <input name="note"  class="form-control" id = "note" type="number" step="0.25" min="0" max="20" placeholder="Note obtenue"><br>
          </div>
          <div class="form-group">
            <input name="semestre"  class="form-control" id ="semestre" required type ="text" placeholder="Semestre"><br>
          </div>
          <div class="form-group">
            <input name="commentaire"  class="form-control" id ="commentaire" type ="text" placeholder="Commentaire"><br>
          </div>
          <div class="form-group">
            <input type="file"  class="form-control" name="fichierUpload" id="fichierUpload" required/>
          </div>
          <input type="hidden" name="MAX_FILE_SIZE" value="5008576" />
          <div class="form-group">
            <input TYPE="submit"  class="form-control" NAME="nom" value=" Envoyer " onclick="javascript:dataLayer.push({'event' : 'formulaireEnvoi'})">
          </div>
        </form>
      </div>
    </div>
    <div class="flexItem">
      <div class="formConteneur">
        <form enctype="multipart/form-data" method="POST" action="?page=upload" id="formFichier">
          <input type="hidden" name="submitted_doc" value="link" />
          <input type="hidden" name="form" value="true" />
          <div class="form-group">
            <!-- <div class="input-append"> -->
              <!-- <input style="width: 1000px;" name="u" autocomplete="on" id="big-search-uv-name" class="search-query span2"  type="text" placeholder="Rechercher une UV"> -->
              <input name="u" autocomplete="on" id="big-search-uv-name" class="form-control"  type="text" placeholder="Rechercher une UV">
            <!-- </div> -->
          </div>
            <div class="form-group">
              
              <select name="selectType" id="selectType" class="form-control" required>            
                <option value="lTD">TD</option>
                <option value="lTP">TP</option>
                <option value="lAnnale">Annale ou correction</option>
                <option value="lRapport">Rapport ou projet</option>
                <option value="lPoster">Poster</option>
                <option value="lAutres">Autres</option>
              </select>
            </div>
          <div class="form-group">
             <input required name="nomfichier"  class="form-control" id ="nomfichier" type ="text" placeholder="Nom du fichier"><br>
          </div>
          <div class="form-group">
             <input required name="lien"  class="form-control" id ="lien" type ="text" placeholder="Lien vers le document"><br>
          </div>
          <div class="form-group">
            <input name="note"  class="form-control" id = "note" type="number" step="0.25" min="0" max="20" placeholder="Note obtenue"><br>
          </div>
          <div class="form-group">
            <input name="semestre"  class="form-control" id ="semestre" required type ="text" placeholder="Semestre"><br>
          </div>
          <div class="form-group">
            <input name="commentaire"  class="form-control" id ="commentaire" type ="text" placeholder="Commentaire"><br>
          </div>
          <div class="form-group">
            <input TYPE="submit"  class="form-control" NAME="nom" value=" Envoyer " onclick="javascript:dataLayer.push({'event' : 'formulaireEnvoi'})">
          </div>
        </form>
      </div>
    </div>
    <div class="flexItem">
      <div class="formConteneur">
      Fonctionnalité à venir :)
      </div>
    </div>
</div>


  <!--     <div class="flexItem" title="Fonctionnalité en préparation :)">
    <div class="choiceItem disabled">
      <h3>Ajout d'un lien vers un document externe</h3>
    </div>
  </div>
  <div class="flexItem" title="Fonctionnalité en préparation :)">
    <div class="choiceItem disabled">
      <h3>Création d'un Pad</h3>
    </div>
  </div> -->