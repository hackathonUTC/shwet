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

    echo "<br><br><br><br>";
    var_dump($_POST);
    echo "Is dir : ".(is_dir ( "./docs/FQ01/TD/" )?'oui':'non');
    $uv = $strtoupper($_POST['u']);
    $type = $_POST['selectType'];
    $nom = $_POST['nomfichier'];
    $note = $_POST['note'];
    $semestre = $_POST['semestre'];
    $commentaire = $_POST['commentaire'];
    $filename = basename($_FILES['fichierUpload']['name']);
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
	
  // if (isUV($uv) && !is_dir( "./docs/".$uv ))
  //   mkdir("./docs/".$uv, '0740');

  // if (isType($type) && !is_dir( "./docs/".$uv."/".$type ))
  //   mkdir("./docs/".$uv."/".$type, '0740');

  	// $upload_fichier = upload($filename,"docs"+$uv+"/"+$type+"/"+$id+"/"+$ext);

  // 
?>
