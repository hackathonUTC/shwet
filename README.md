#Shwet

## État général

###*Fonctionnalités disponibles :*
* Consultation des documents par UV/Branche
* Vote +1/-1 pour les documents
* Upload de fichiers et ajout de liens vers des documents en ligne


###*Fonctionnalités souhaitées :* 
* Tri des documents par nom, note ou vote
* Support des commentaires (compléter upload.php)
* Système de pad pour le travail en commun capitalisé
* Page d'administration (ajout, modif, suppression d'un document ou d'une UV)
* Outils d'upload amélioré : barre de progression, réutilisation des paramètres UV, type et semestre de l'ajout précédent

###*Bugs :*
* Corriger les bugs de :hovers

###*Technologie :*
* Backend PHP
* Base MySQL
* Tous le code javaScript est présent dans le fichier shwet.js




## Doc de l'API
### *docvote.php*
Permet à un utilisateur de voter +1 ou -1 pour un document :

#### IN
On passe en POST :
* `doc` : l'id du document
* `user` : l'utilisateur (ya une astuce, demander à Mewen)
* `val` : +1 ou -1

#### OUT
On reçoit un des résultats parmis :
* "erreur" : val est incorrecte ou bien un des paramètres est vide
* "unknown user" : l'user transmis est incorrect
* "erreur : une requete interne a echoue" : l'insertion qui vient d'être faite n'est pas visible (erreur impossible normalement)
* "faut attendre" : l'utilisateur a fait sa dernière action il y a moins d'une minute, il faut attendre ! (ça ne remet pas le minuteur à 0)
* 1 ou -1 : le vote a fonctionné, on retourne val


### *getdocs.php*
Permet à un utilisateur de voter +1 ou -1 pour un document :
#### IN
On passe en POST :
* `uv` : la référence de l'UV
* `user` : l'utilisateur (pareil, demander à Mewen)

#### OUT
On reçoit un json qui est un tableau d'objets (chaque objet est un document) :
* 'id' : du document
* 'uv' : référence de l'UV, c'est vrai qu'elle est pas méga utile celle là ^^
* 'type', 'nom', 'extension', 'note', 'semestre', 'etu' : voir sql/README.md
* 'rank' : note du document (entier relatif), plus il est haut, mieux le document est noté
* 'user_rank' : note donnée à ce document par l'utilisateur qui fait la requête (-1 ou 1, 0/NULL s'il n'a pas encore voté)

### *getuv.php*
Retourne des infos sur une UV :
#### IN
On passe en POST `uv`

#### OUT
On reçoit un json qui est un tableau avec les infos de l'UV en question et la liste des branches dans lesquelles cette UV est dispo. En fait, c'est un tableau où 'uv' et 'titreuv' sont identiques mais où 'branche' diffère :
* 'branche' : une des branches dans lesquelles on peut prendre cette UV
* 'uv' : référence de l'UV (pas ouf utile non plus)
* 'titreuv' : titre complet de l'UV

### *getuvs.php*
Renvoie la liste des UVs d'une branche ou toutes branches confondues :
#### IN
On passe en POST le paramètre optionnel `branche`

#### OUT
On reçoit un json qui est un tableau d'UVs, sous la forme :
* 'uvname' : référence de l'UV
* 'uvtitre' : titre complet de celle-ci
* 'nbdocs' : nombre de documents ou lien en ligne (peut valoir 0 ou NULL)
