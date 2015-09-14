//GA Send Pageview and Install

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})
(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-64077388-1', 'auto');
ga('send', 'pageview');


//Basic function

getURLParams = function(key, url) {
    var result = "";

    if (key !== undefined && key !== null) {
        key = key.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        url = url || window.location.href;

        var regexS = "[\\?&]" + key + "=([^&#]*)";
        var regex = new RegExp(regexS);
        var results = regex.exec(url);

        if (results !== null) {
            result = results[1];
        }
    }

    return result;
};

pageType = getURLParams("page");

$( document ).ready(function() {
//Autocompletion Fonction for Search Form
if(document.location.pathname.indexOf("index")==-1){ 
//On fait l'autocompletion dans toute les pages sauf l'index
	try{
		var listUV = $.ajax({
  			type: 'POST',
  			url: document.location.protocol + "//assos.utc.fr/shwet/getuvs.php",
  			data: {branche : ""},
  			async:false
		});

		listUV = JSON.parse(listUV.responseText);
		listUVs = [];
		for(var i =0; i < listUV.length ; i ++){
   			listUVs[i] = listUV[i].uvname;
		}
		$('#search-uv-name').autocomplete({
    		source : listUVs,
			select: function(event, ui) {
				$("#search-uv-name").val(ui.item.label);
            	$("#search-uv-form").submit(); }
			});

			if(document.location.href.indexOf("?page=ajout")!=-1){
				$('#big-search-uv-name').autocomplete({
    				source : listUVs,
     				select: function(event, ui) { 
						$("#big-search-uv-name").val(ui.item.label);
            			$("#big-search-uv-form").submit(); }
					});
					
				$('#big-search-uv-name2').autocomplete({
    				source : listUVs,
     				select: function(event, ui) { 
						$("#big-search-uv-name2").val(ui.item.label);
            			$("#big-search-uv-form2").submit(); }
					});
					
			}
		}catch(e){};
}


//Fonction pour les pages Branches (Ca serait mieux en Angular :p)

if(pageType=="branche"){
	var branche = getURLParams("b");
	var listBranche = ["GI","GB","GSM","GSU","GP","GM","TC","TSH"]
	if(listBranche.indexOf(branche)!=-1){
		document.getElementById("title").innerHTML = "<h1>" + branche + "</h1>";
		document.getElementById(branche + "Selecteur").className = "active" ;
	}
	else {
    	branche = "";
     	document.getElementById("title").innerHTML = "<h1>Toutes les UVs</h1>";
   		document.getElementById("ALLSelecteur").className = "active" ;	
   	}
	uvs = $.ajax({
  		type: 'POST',
  		url: document.location.protocol + "//assos.utc.fr/shwet/getuvs.php",
  		data: {branche : branche},
  		async:false
	});
	var letter = "TEMP";

	try{
		uvs = JSON.parse(uvs.responseText);
	} catch(e){}

	var currentColumn = 0;
	var i = 0;
	var div = null;
	do { // pour chaque lettre
		// si nécessaire on change de colonne
		if (i >= parseInt(currentColumn * uvs.length/4)) {
			// si on a trop d'UV dans cette colonne, on ajoute une colonne
   			div = document.createElement('div');
   			div.className = "span3";
   			currentColumn += 1;
		};

   		letter = uvs[i].uvname[0];
		table = document.createElement('table');
		table.className="table table-condensed table-bordered table-striped";
		table.id = "UV-" + letter ; 
   		div.appendChild(table);
		tr = document.createElement('tr');
		thead = document.createElement('thead');
		th1 =  document.createElement('th');
		th1.appendChild(document.createTextNode(letter));
		th2 =  document.createElement('th');
		th2.appendChild(document.createTextNode("Nombre de documents"));
		tr.appendChild(th1);
		tr.appendChild(th2);
		thead.appendChild(tr);
		table.appendChild(thead);
   		document.getElementById("list-container").appendChild(div);

		// on ajoute les UVs commençant par cette lettre
		while (uvs[i].uvname[0] == letter) {
   			tr = document.createElement('tr');
			tr.id=uvs[i].uvname;
			td = document.createElement('td');
			a = document.createElement("a");
			a.href = "/shwet?page=uv&u=" + uvs[i].uvname;
			a.appendChild(document.createTextNode(uvs[i].uvname));
			td.appendChild(a);
			tr.appendChild(td);
			td2= document.createElement('td');
	  		if(uvs[i].nbdocs==null){
				td2.appendChild(document.createTextNode("0"));
	  		}
	  		else {
	    		td2.appendChild(document.createTextNode(uvs[i].nbdocs));
	  		}
			tr.appendChild(td2);
			document.getElementById("UV-"+letter).appendChild(tr);
   			i += 1;
		};


	} while (i < uvs.length);

}

//Fonction pour les pages Uvs 

if(pageType=="uv"){
	var uv = getURLParams("u").toUpperCase();
	var listUV = $.ajax({
  		type: 'POST',
  		url: document.location.protocol + "//assos.utc.fr/shwet/getuvs.php",
  		data: {branche : ""},
  		async:false
	});

	listUV = JSON.parse(listUV.responseText);
	listUVs = [];

	for(var i =0; i < listUV.length ; i ++){
   		listUVs[i] = listUV[i].uvname;
   		if(uv==listUV[i].uvname) 
   			uvtitre=listUV[i].uvtitre;
  	}

	if(listUVs.indexOf(uv)!=-1){
		document.getElementById("title").innerHTML = "<h1>" + "<a href='https://assos.utc.fr/uvweb/uv/" + uv + "'>"+ uv + "</a>" + " - " + uvtitre + "</h1>";
		div = document.createElement('div');
		div.className = "span3";
		h4 = document.createElement("h4");
		h4.appendChild(document.createTextNode("Annales"));
		a = document.createElement("a");
		a.href = "https://assos.utc.fr/polar/annales/voir?u=" + uv;
		a.appendChild(document.createTextNode("Annales du Polar"));
		div.appendChild(h4);
		br = document.createElement("br");
		div.appendChild(a);
		div.appendChild(br);
		a2 = document.createElement("a");
		a2.href = "http://assos.utc.fr/annaleut/smart_search/?q=" + uv;
		a2.appendChild(document.createTextNode("Annale UT"));
		div.appendChild(a2);
		document.getElementById("docs-container").appendChild(div);
	}
	else {
    	document.getElementById("title").innerHTML = "<h1>UV Inconnue ! Try again</h1>";
	}

	docs = $.ajax({
  		type: 'POST',
  		url:  document.location.protocol + "//assos.utc.fr/shwet/getdocs.php",
  		data: {uv : uv},
  		async:false
	});

	try{
		docs = JSON.parse(docs.responseText);
	} catch(e){}

	type = "TEMP";

	for( var i =0 ; i < docs.length; i++){
		if(docs[i].type!=type){
   			type = docs[i].type;
   			div = document.createElement('div');
   			div.className = "span3";
   			h4 = document.createElement("h4");
   			if (type[0] == 'l'){
				h4.appendChild(document.createTextNode(type.substring(1,type.length) + " externe"));
   				span = document.createElement("span");
				span.appendChild(document.createTextNode("i"));
				span.className = "info";
				span.title = "Ces documents pointent vers des liens externes (genre Drive). Ils s'ouvrent dans l'onglet actuel";
				h4.appendChild(span);
   				div.appendChild(h4);
   			} else {
				h4.appendChild(document.createTextNode(type));
   				div.appendChild(h4);
   			}
   			table = document.createElement('table');
   			table.className="table table-condensed table-bordered table-striped";
   			table.id = "doc-" + type;
   			div.appendChild(table);
   			tr = document.createElement('tr');
   			thead = document.createElement('thead');
   			th1 =  document.createElement('th');
   			th1.appendChild(document.createTextNode("Documents"));
			tr.appendChild(th1);
			thead.appendChild(tr);
   			table.appendChild(thead);
   			document.getElementById("docs-container").appendChild(div);
  		}
		tr = document.createElement('tr');
		tr.id=docs[i].id;
		td = document.createElement('td');
		a = document.createElement("a");
		a.href = "docs/" + docs[i].uv + "/" + docs[i].type + "/" + docs[i].id + "." + docs[i].extension;
		a.appendChild(document.createTextNode(docs[i].nom));
		td.appendChild(a);
		tr.appendChild(td);
		document.getElementById("doc-"+type).appendChild(tr);
	}

	if(docs.length==0){
   		h4 = document.createElement("h4");
   		h4.appendChild(document.createTextNode("Aucun document disponible pour cette UV"));
   		document.getElementById("docs-container").appendChild(h4);
	}
}

if(pageType=="ajout"){
	$('#ajoutFichier').bind('click', function() {
		// document.getElementById('formulaireFichier').style.visibility='visible';
		// document.getElementById('formulaireExterne').style.visibility='hidden';
		if (!$('#ajoutFichier').hasClass("active")){
			$("#vide").slideUp();
			$("#formulaireFichierIn").slideDown();
			$("#formulaireExterneIn").slideUp();
			$("#ajoutFichier").addClass("active");
			$("#ajoutExterne").removeClass("active");
		} else {
			$("#ajoutFichier").removeClass("active");
			$("#formulaireFichierIn").slideUp();
			$("#vide").slideDown();
		}
	});

	$('#ajoutExterne').bind('click', function() {
		// document.getElementById('formulaireExterne').style.visibility='visible';
		// document.getElementById('formulaireFichier').style.visibility='hidden';
		if (!$('#ajoutExterne').hasClass("active")){
			$("#vide").slideUp();
			$("#formulaireFichierIn").slideUp();
			$("#formulaireExterneIn").slideDown();
			$("#ajoutFichier").removeClass("active");
			$("#ajoutExterne").addClass("active");
		} else {
			$("#vide").slideDown();
			$("#ajoutExterne").removeClass("active");
			$("#formulaireExterneIn").slideUp();
		}
	});


	$("#vide").height( 0.25*$( window ).height());
};

var verificationUV = function(uvID){
	uv = document.getElementById(uvID).value;

	var listUV = $.ajax({
  		type: 'POST',
  		url: "http://assos.utc.fr/shwet/getuvs.php",
  		data: {branche : ""},
  		async:false
	});

	listUV = JSON.parse(listUV.responseText);
	listUVs = [];
	for(var i =0; i < listUV.length ; i ++){
   		listUVs[i] = listUV[i].uvname;
	}

	if(listUVs.indexOf(uv)!=-1){
	var formulaire = {
    	 "uv" : uv,
     	"type" : document.getElementById("selectType").value,
     	"nom" : document.getElementById("nomfichier").value,
     	"note" : document.getElementById("note").value,
     	"semestre" : document.getElementById("semestre").value,
     	"commentaire" : document.getElementById("commentaire").value
	}}
	else  {
		alert("UV NON VALIDE");
	}
}

//JS pour les formulaires d'ajouts
$('#envoieAjout').bind('click', function() {
	verificationUV("big-search-uv-name");
});

$('#envoieAjout2').bind('click', function() {
	verificationUV("big-search-uv-name2");
});

})
