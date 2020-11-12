<?php 
require '_header-DB.php';
?>
<?php

$exist = $DB->query('SELECT * FROM objet WHERE ID_obj=:id',array('id'=>$_POST['ID_obj']));

if(!empty($exist)){

	if(isset($_POST['modif'])){

		if(empty($_POST["ID_obj"]) OR empty($_POST["nom_obj"]) OR empty($_POST["prix_obj"]) OR empty($_POST["cat_obj"]) OR empty($_POST["nb_obj"]) OR !is_numeric($_POST["prix_obj"])){
			die("Veuillez remplir correctement tous les champs. <a href='javascript:history.back()'>Retourner</a>");
		}else{

			if(strlen($_POST['nb_obj'])<11){

				$modifcat = $DB->emptyquery("UPDATE objet SET cat_obj=:cat WHERE ID_obj=:id",array('cat'=>$_POST['cat_obj'], 'id'=>$_POST['ID_obj']));
				$modifnom = $DB->emptyquery("UPDATE objet SET nom_obj=:nom WHERE ID_obj=:id",array('nom'=>$_POST['nom_obj'], 'id'=>$_POST['ID_obj']));
				$modifprix = $DB->emptyquery("UPDATE objet SET prix_obj=:prix WHERE ID_obj=:id",array('prix'=>$_POST['prix_obj'], 'id'=>$_POST['ID_obj']));
				$modifqte = $DB->emptyquery("UPDATE objet SET nb_obj=:nb WHERE ID_obj=:id",array('nb'=>$_POST['nb_obj'], 'id'=>$_POST['ID_obj']));

				die("Le produit a bien été modifié. <a href='javascript:history.back()'>Retourner</a>");

			}else{

				die("Le nombre de caractère de la Quantité doit être en-dessous de 11. <a href='javascript:history.back()'>Retourner</a>");
			}
		}
	}

	if(isset($_POST['suppr'])){
		$suppr = $DB->emptyquery('DELETE FROM objet WHERE ID_obj=:id',array('id'=>$_POST['ID_obj']));
		die("Le produit ".$_POST['ID_obj']." vient d'être supprimer. <a href='javascript:history.back()'>Retourner</a>");
	}
}else{
	die("Le produit ".$_POST['ID_obj']." n'existe pas. <a href='javascript:history.back()'>Retourner</a>");
}

?>