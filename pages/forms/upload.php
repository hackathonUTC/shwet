<?php
include_once('classes/Bitly.class.php');
include('db_connect.php');

function upload($index,$destination)
{
   //Test1: fichier correctement uploadé
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
   //Déplacement
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}

function isUV($uv){
  $req = "SELECT COUNT(*) FROM uvbranche WHERE uv='".mysql_escape_string($uv)."';";
  $retour = db_query($req);
  $row = mysql_fetch_array($retour);
  if ( intval($row['COUNT(*)']) > 0){
    return true;
  } else {
    return false;
  }
}

function insert($id, $uv, $type, $nom, $extension, $note, $semestre){
  $req = "INSERT INTO `docs` (`id`, `uv`, `type`, `nom`, `extension`, `note`, `semestre`, `etu`) VALUES
        ('$id','$uv' , '$type', '".mysql_escape_string($nom)."', '$extension', ".intval($note).", '".mysql_escape_string($semestre)."', '".$_SESSION['user']."'');";
  db_query($req);
}

function isType($type, $isDoc){
  if ( $isDoc ){
    $liste = array(
      'TD',
      'TP',
      'Annale',
      'Rapport',
      'Poster',
      'Autres'
    );
  } else {
    $liste = array(
      'lTD',
      'lTP',
      'lAnnale',
      'lRapport',
      'lPoster',
      'lAutres'
    );
  }

  if(in_array($type, $liste))
    return true;
  else
    return false;
}

function isSemestreCorrect($sem){
  if ( (strlen($sem) !=3) ) {
    return false;
  } else {
    list($scan_char, $scan_annee ) = sscanf( $sem , "%c%d"); // on décompose la référence de semestre

    if ( ($scan_char != 'P') && ($scan_char != 'A') ){ // c'est bien un automne ou un printemps
      return false;
    }

    if ( ($scan_annee < 0) || ($scan_annee > intval(date("y"))) ) { // l'année est correcte
      return false;
    }
  }

  return true;
}

function generateFileId(){
  return date("YmdGis");
}

function verifyLink($p){

  if ( !isType($p['selectType'], false) ){
    Messages::future_warn("Type de document incorrect !");
    return false;
  }
  
  // on vérifie autre chose ??

  return true;
}

function verifyDoc($p){

  if ( !isType($p['selectType'], true) ){
    Messages::future_warn("Type de document incorrect !");
    return false;
  }

  // Vérifications :
  // taille fichier
  $filesize = filesize($_FILES['fichierUpload']['tmp_name']);
  if ( ($filesize > MAX_FILE_SIZE) || ($filesize < MIN_FILE_SIZE) ){
    Messages::future_warn("Un fichier doit être ni trop lourd, ni trop léger ! Bah là c'était pas ça :P");
    return false;
  }

  // type Mime correct

  // nom avec des caractères potables (?)

  // nom < 255 caractères
  if (mb_strlen($filename,"UTF-8") > 225){
    Messages::future_warn('Le nom de fichier est trop long ! Merci de le renommer !');
  }


  return true;
}

function verifyCommon($n){
  if (intval($n['note'])>20 || intval($n['note'])<0) { // note incorrecte
    Messages::future_warn('La note donnée n\'est pas correcte (sur 20) !');
    return false;
  }

  if ( !isUV($n['u']) ){
    Messages::future_warn('Cette UV n\'existe pas dans notre base ! Si elle existe réellement, envoyez-nous un mail à shwet@assos.utc.fr :)');
    return false;
  }

  if ( !isSemestreCorrect(strtoupper($n['semestre'])) ){
    Messages::future_warn("Semestre incorrect !");
    return false;
  }

  // vérifier que les non nuls sont bien non nuls ! XXX

  return true;
}

function getExternalHost($lien){
  if ( strstr($lien, "google.") && strstr($lien, "drive") )
    return "ggdv";

  if ( strstr($lien, "dropbox.com") || strstr($lien, "db.tt") )
    return "dpbx";

  if ( strstr($lien, "office.live.") )
    return "msof";

  if ( strstr($lien, "github.com") || strstr($lien, "github.io") || strstr($lien, "git.io") )
    return "gith";

  if ( strstr($lien, "facebook.") || strstr($lien, "facebook.") )
    return "fb";

  return "none";
}


if (isset($_POST['submitted_doc']) && !empty($_POST['submitted_doc'])) {

  if ( $_POST['submitted_doc']=="link" && verifyCommon($_POST) &&  verifyLink($_POST) ) { // si c'est un lien
    $lien = Bitly::shorten($_POST['lien']);

    if ( !empty($lien) ){
      $uv = strtoupper($_POST['u']);
      $type = $_POST['selectType'];
      $nom = $_POST['nomfichier'];
      $extHost = getExternalHost($_POST['lien']);
      $note = $_POST['note'];
      $semestre = strtoupper($_POST['semestre']);
      insert($lien, $uv, $type, $nom, $extHost, $note, $semestre);

      Messages::future_info('Le lien a bien été ajouté, merci :)');
    } else {
      Messages::future_error('Shit, on a eu un soucis en raccourcissant l\'URL, tu es sûr(e) qu\'elle est correcte ? Si oui, mail nous shwet@assos.utc.fr');
    }
  } else if ( $_POST['submitted_doc']=="file" && verifyCommon($_POST) && verifyDoc($_POST) ) { // si c'est un fichier
    $id = generateFileId();
    $uv = strtoupper($_POST['u']);
    $type = $_POST['selectType'];
    $nom = $_POST['nomfichier'];
    $note = $_POST['note'];
    $semestre = strtoupper($_POST['semestre']);

    $filename = basename($_FILES['fichierUpload']['name']);
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $path = "docs/".$uv."/".$type."/";

    // création du dossier si nécessaire
    if (!is_dir( $path )){
      if (!mkdir( $path , 0664)){
        Messages::future_error("Erreur lors de la création du dossier '".$path."' :/ (c'est pas ta faute ^^ envoie juste un mail à shwet@assos.utc.fr)");
      } else {
        Messages::debug("Dossier ".$path." créé :) ");
      }
    }

    if (is_dir( $path )){
      // déplacement du fichier
      if( move_uploaded_file( $_FILES["fichierUpload"]["tmp_name"], $path.$id.".".$ext ) ){
        Messages::debug("Fichier déplacé \o/ ");

        insert($id, $uv, $type, $nom, $ext, $note, $semestre);

        Messages::future_info('Le fichier a bien été uploadé, merci :)');
      } else {
        Messages::future_error("Erreur au déplacement de " . $_FILES["fichierUpload"]["tmp_name"] ." à ". $path.$id.".".$ext."  (c'est pas ta faute ! dis-le nous à shwet@assos.utc.fr)");
      }
    }

  } else {
    // Ya une erreur, retour à l'envoyeur
  }

  // var_dump($_SESSION);
  header('Location: ?page=ajout');

} else {
  Messages::future_error("Il y a eu une erreur mais c'est pas ta faute :P envoie un mail à shwet@assos.utc.fr en disant 'SHWET:ERROR->REMEDIATION' ");
}



  // var_dump($_FILES);
?>
