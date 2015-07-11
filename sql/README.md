# Structure de la BD de Shwet

Voilà la structure des tables + les conventions prise :

### uvbranche
* `branche VARCHAR(3)` parmis GP, GB, GI, GM, GSM, GSU, TC, TSH
* `uv VARCHAR(5)`
* `titreuv VARCHAR(255)`

Liste des uvs posibles dans le système. On a plusieurs lignes pour la même UV car on précise les branches dans lesquelles ont peut la faire (c'est pas du 3NF, olalaaa).

### etu
* `login CHAR(8)`
* `lastAction DATETIME` la date de la dernière action (en écriture) réalisée via l'API, pour éviter d'avoir un bot qui spamme les votes par exemple. On a le droit de faire une action chaque minute actuellement (voir /db_connect.php)

### docs
* `id VARCHAR(15)`
* `uv VARCHAR(5)` référence vers une uv (mais pas une fk)
* `type VARCHAR(10)` 
* `nom VARCHAR(255)` nom naturel donné au document, sert uniquement à l'affichage
* `extension VARCHAR(4)`
* `note TINYINT` la note obtenue grâce à ce document, s'il y a lieu
* `semestre CHAR(3)` sous la forme 'P15'
* `etu CHAR(8)` qui est une fk vers un `etu` (comme c'est surprenant !)

Deux cas de figure :
#### Fichier
* L'`id` est alors le nom du fichier dans le système de fichier.
* L'`extension` correspond à l'extension dans le système de fichier.
* Le `type` est parmis `TD`, `TP`, `Annale` (inclus les corrections du prof ou des étudiants), `Rapport` (inclus les projets), `Poster`, `Autres`

#### Liens vers l'extérieur
* L'`id` est alors la partie unique URL du fichier extérieur (raccourcie via bitly). L'id `1d9huUQ` correspond donc à http://bit.ly/1d9huUQ.
* L'`extension` correspond à un code identifiant le site extérieur :
    * `ggdv` pour Google Drive,
    * `dpbx` pour Dropbox,
    * `fb` pour Facebook,
    * `msof` pour Office Online,
    * `gith` pour Github,
    * `none` pour un autre site
* Le `type` est parmis est le même que pour fichier mais préfixé d'un `l`.

### avis
* `doc VARCHAR(15)` une fk vers un `docs`
* `valeur TINYINT` la valeur du vote (-1 ou +1)
* `etu CHAR(8)` une fk vers un `etu`
Si un étudiant vote deux fois pour le même document, ça modifie son vote