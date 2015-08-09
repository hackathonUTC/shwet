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

	for( var i =0 ; i < uvs.length; i++){
		if(uvs[i].uvname[0]!=letter){
   			letter = uvs[i].uvname[0];
   			div = document.createElement('div');
   			div.className = "span3";
   			table = document.createElement('table');
   			table.className="table table-condensed table-bordered table-striped";
   			table.id = "UV-" + letter ; 
   			div.appendChild(table);
   			thead = document.createElement('thead');
   			th1 =  document.createElement('th');
   			th1.appendChild(document.createTextNode(letter));
   			th2 =  document.createElement('th');
   			th2.appendChild(document.createTextNode("Nombre de documents"));
   			thead.appendChild(th1);
   			thead.appendChild(th2);
   			table.appendChild(thead);
   			document.getElementById("list-container").appendChild(div);
  		}
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
	}
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
   			h4.appendChild(document.createTextNode(type));
   			div.appendChild(h4);
   			table = document.createElement('table');
   			table.className="table table-condensed table-bordered table-striped";
   			table.id = "doc-" + type ; 
   			div.appendChild(table);
   			thead = document.createElement('thead');
   			th1 =  document.createElement('th');
   			th1.appendChild(document.createTextNode("Documents"));
   			thead.appendChild(th1);
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

