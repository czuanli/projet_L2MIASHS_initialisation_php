<?php 
require '_header-DB.php';
?>
<?php
$ID_obj=$_POST["ID_obj"];
$ID_vend=$_POST["ID_vend"];
$nom_obj=$_POST["nom_obj"];
$prix_obj=$_POST["prix_obj"];
$cat_obj=$_POST["cat_obj"];
$nb_obj=$_POST["nb_obj"];


if(empty($ID_obj) OR empty($nom_obj) OR empty($prix_obj) OR empty($cat_obj) OR empty($nb_obj) OR !is_numeric($prix_obj)){
	die("<p> Veuillez remplir correctement tous les champs. <a href='javascript:history.back()'>Retourner</a></p>");
}
else{

	if(strlen($_POST['ID_obj'])<11 AND strlen($_POST['nb_obj'])<11){
		$infoproduit = array(
		'id'=>$ID_obj,
		'vendeur'=>$ID_vend,
		'nom'=>$nom_obj,
		'prix'=>$prix_obj,
		'cat'=>$cat_obj,
		'nb_obj'=>$nb_obj
		);
		$verif = $DB->query('SELECT * FROM objet WHERE ID_obj=:id',array('id'=>$ID_obj));
		if($verif){
			die("Ce Code Produit est déjà pris. <a href='javascript:history.back()'>Retourner</a>");
		}
		$resultat = $DB->emptyquery('INSERT INTO objet(ID_obj, ID_vend, nom_obj, prix_obj, cat_obj, nb_obj) 
			VALUES (:id, :vendeur, :nom, :prix, :cat, :nb_obj)', $infoproduit);
		die("Le produit a bien été ajouté au panier. <a href='javascript:history.back()'>Retourner</a>");
	}else{
		die("Le nombre de caractère du Code Produit et de la Quantité doivent être en-dessous de 11. <a href='javascript:history.back()'>Retourner</a>");
	}

	
	}
?>