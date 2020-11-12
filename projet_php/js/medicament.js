
function nbproduit(nb){
	if(nb==0){
		alert("Vous avez séléctionné 0 produit. Nous ne pouvons l'ajouter au panier");
	}
	if(nb==10){
		alert("La quantité que vous achetez peut nuire à votre santé");
	}

	if(nb!=0 && nb!=10){
		alert("La quantité que vous avez sélectionné est de : "+nb)	
	}
}

function pt(prix,qte){
	prix=document.getElementById('prix').value;
	qte= document.getElementById('quantite').value;
	var prixtotal=prix*qte;
	document.getElementById("prixtotal").innerHTML=prixtotal;	
}



function updatePanier(elmt, nom, qte, prix){
	var tr = document.createElement('tr');
	elmt.appendChild(tr);

	var td = document.createElement('td');
	tr.appendChild(td);
	var td1 = document.createElement('td');
	tr.appendChild(td1);
	var td2 = document.createElement('td');
	tr.appendChild(td2);
	var tdnom= document.createTextNode(nom);
	td.appendChild(tdnom);
	var tdqte=document.createTextNode(qte);
	td1.appendChild(tdqte);
	var tdprix=document.createTextNode(prix);
	td2.appendChild(tdprix);
}

