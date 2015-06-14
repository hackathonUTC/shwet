<?php
$fUpload = 'upload/'; // dossier de destination
$fName = 'test'; // nom du fichier de destination
$fPost = $_FILES['img']; // fichier envoyé
// liste des format de fichier accepté
$lst = array('image/gif'=>'gif', 'image/jpeg'=>'jpg', 'image/pjpeg'=>'jpg', 'image/png'=>'png');
$fType = $lst[$fPost['type']]; // type du fichier qui nous intéresse
$fPath = $fUpload.$fName.'.'.$fType; // chemin complet après déplacement
if(empty($fType)){
	// fichier inconnu
	echo 'Fichier de type inconnu';

}else if(move_uploaded_file($fPost['tmp_name'], $fPath)){
	// le fichier a été correctement déplacé
	echo '<p>Image chargée : <b>'.$fName.'.'.$fType.'</b><br />
	MIME : <b>'.$fPost['type'].'</b> <br />
	Poids : <b>'.round(filesize($fPath) / 1024, 2).' Ko</b></p>
	<p><img src="'.$fPath.'" height="200px" alt="'.$fName.'" /></p>';

}else{
	// le fichier n'a pas été déplacé
	echo 'erreur';
}
?>
