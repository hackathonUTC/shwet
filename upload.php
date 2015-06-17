<?php
include 'verify_connection.php';
include 'header.php';


function upload($index,$destination)
{
   //Test1: fichier correctement uploadé
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
   //Déplacement
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}

function isUV($uv){
  include('db_connect.php');

  $req = "SELECT COUNT(*) FROM uvbranche WHERE uv='".mysql_escape_string($uv)."';";
  $retour = db_query($req);
  $row = mysql_fetch_array($retour);
  if ( intval($row['COUNT(*)']) > 0){
    return true;
  } else {
    return false;
  }
}

function isType($type){
  // ========= /!\ attention : à refaire ! =======
  if (($type == "TP") || ($type == "TD") || ($type == "Autres"))
    return true;
  else
    return false;
}

  echo "<br><br><br><br>";
  // var_dump($_POST);
  // echo "Is dir : ".(is_dir ( "./docs/FQ01/TD/" )?'oui':'non');
  $uv = strtoupper($_POST['u']);
  $type = $_POST['selectType'];
  $nom = $_POST['nomfichier'];
  $note = $_POST['note'];
  $semestre = $_POST['semestre'];
  $commentaire = $_POST['commentaire'];
  $filename = basename($_FILES['fichierUpload']['name']);
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  $path = "./docs/".$uv."/".$type."/";

  // ========= /!\ attention : à refaire ! =======
  $id = "cdvnejbomd";

  if (isUV($uv) && isType($type) && !is_dir( $path )){
    if (mkdir( $path , 0777)){
      echo "Dossier ".$path." créé :) ";
        // $upload_fichier = upload($filename, $path.$id.".".$ext );
      if( move_uploaded_file( $_FILES["fichierUpload"]["tmp_name"], $path.$id.".".$ext ) ){
        echo "Fichier déplacé \o/ ";
      } else {
        echo "Erreur au déplacement de " . $_FILES["fichierUpload"]["tmp_name"] ." à ". $path.$id.".".$ext."   ";
      }
    } else
      echo "Erreur lors de la création d'un dossier :/ ";

  } else {
      echo "Le dossier existe déjà ou bien ça n'est pas une uv ! ";
      if( move_uploaded_file($_FILES["fichierUpload"]["tmp_name"], $path.$id.".".$ext ) ){
        echo "Fichier déplacé \o/ ";
      } else {
        echo "Erreur au déplacement de " . $_FILES["fichierUpload"]["tmp_name"]." à ". $path.$id.".".$ext."   ";
      }
  }
  // var_dump($_FILES);
?>
