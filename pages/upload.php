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
  $req = "INSERT INTO `docs` (`id`, `uv`, `type`, `nom`, `extension`, `note`, `semestre`) VALUES
        ('$id','$uv' , '$type', '".mysql_escape_string($nom)."', '$extension', ".intval($note).", '".mysql_escape_string($semestre)."');";
  db_query($req);
}

function isType($type, $isDoc){
  var_dump($type);
  if (( $isDoc && (($type == 'TD') || ($type == 'TP') || ($type == 'Annale') || ($type == 'Rapport') || ($type == 'Poster') || ($type == 'Autres') )) ||
      (!$isDoc && (($type == 'lTD') || ($type == 'lTP') || ($type == 'lAnnale') || ($type == 'lRapport') || ($type == 'lPoster') || ($type == 'lAutres') )) )
    return true;
  else {
    return false;
  }
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
  // ========= /!\ attention : à refaire ! =======
  return "cdvnejbomd";
}

function verifyLink($p){

  if ( !isType($_POST['selectType'], false) ){
    Messages::warn("Type de document incorrect !");
    return false;
  }
  
  // on vérifie autre chose ??

  return true;
}

function verifyDoc($p){

  if ( !isType($_POST['selectType'], true) ){
    Messages::warn("Type de document incorrect !");
    return false;
  }

  // Vérifier : taille fichier, type

  return true;
}

function verifyCommon($n){
  if (intval($_POST['note'])>20 || intval($_POST['note'])<0) { // note incorrecte
    Messages::warn('La note donnée n\'est pas correcte (sur 20) !');
    return false;
  }

  if ( !isUV($_POST['u']) ){
    Messages::warn('Cette UV n\'existe pas dans notre base ! Si elle existe réellement, envoyez-nous un mail à shwet@assos.utc.fr :)');
    return false;
  }

  if ( !isSemestreCorrect(strtoupper($_POST['semestre'])) ){
    Messages::warn("Semestre incorrect !");
    return false;
  }

  // vérifier que les non nuls sont bien non nuls !!!!!!!!!!!!!!!!

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


var_dump($_POST);
echo "<br><br><br>";

if (isset($_POST['submitted_doc']) && !empty($_POST['submitted_doc'])) {

  if ( $_POST['submitted_doc']=="link" && verifyCommon($_POST) &&  verifyLink($_POST) ) { // si c'est un lien
    $lien = Bitly::shorten($_POST['lien']);
    $uv = strtoupper($_POST['u']);
    $type = $_POST['selectType'];
    $nom = $_POST['nomfichier'];
    $extHost = getExternalHost($_POST['lien']);
    $note = $_POST['note'];
    $semestre = strtoupper($_POST['semestre']);
    insert($lien, $uv, $type, $nom, $extHost, $note, $semestre);
  } else if ( $_POST['submitted_doc']=="file" && verifyCommon($_POST) && verifyDoc($_POST) ) { // si c'est un fichier
    $id = generateFileId();
    $uv = strtoupper($_POST['u']);
    $type = $_POST['selectType'];
    $nom = $_POST['nomfichier'];
    $extension = "";
    $note = $_POST['note'];
    $semestre = strtoupper($_POST['semestre']);
    // insert($lien, $uv, $type, $nom, $extHost, $note, $semestre);
  } else {
    // Paramètre incorrect, inclusion de la page d'upload
  }

} else {
  Messages::error("Il y a eu une erreur mais c'est pas ta faute :P envoie un mail à shwet@assos.utc.fr en disant 'SHWET:ERROR->REMEDIATION' ");
}




  // echo "Is dir : ".(is_dir ( "./docs/FQ01/TD/" )?'oui':'non');

  // $uv = strtoupper($_POST['u']);
  // $type = $_POST['selectType'];
  // $nom = $_POST['nomfichier'];
  // $note = $_POST['note'];
  // $semestre = $_POST['semestre'];
  // $commentaire = $_POST['commentaire'];
  // $filename = basename($_FILES['fichierUpload']['name']);
  // $ext = pathinfo($filename, PATHINFO_EXTENSION);
  // $path = "./docs/".$uv."/".$type."/";
  // $id = generateFileId();

  // if (isUV($uv) && isType($type) && !is_dir( $path )){
  //   if (mkdir( $path , 0777)){
  //     echo "Dossier ".$path." créé :) ";
  //       // $upload_fichier = upload($filename, $path.$id.".".$ext );
  //     if( move_uploaded_file( $_FILES["fichierUpload"]["tmp_name"], $path.$id.".".$ext ) ){
  //       echo "Fichier déplacé \o/ ";
  //     } else {
  //       echo "Erreur au déplacement de " . $_FILES["fichierUpload"]["tmp_name"] ." à ". $path.$id.".".$ext."   ";
  //     }
  //   } else
  //     echo "Erreur lors de la création d'un dossier :/ ";

  // } else {
  //     echo "Le dossier existe déjà ou bien ça n'est pas une uv ! ";
  //     if( move_uploaded_file($_FILES["fichierUpload"]["tmp_name"], $path.$id.".".$ext ) ){
  //       echo "Fichier déplacé \o/ ";
  //     } else {
  //       echo "Erreur au déplacement de " . $_FILES["fichierUpload"]["tmp_name"]." à ". $path.$id.".".$ext."   ";
  //     }
  // }

  // var_dump($_FILES);
?>
