<?php
require '_header-DB.php';
?>
<?php 

$exist = $DB->query('SELECT * FROM vendeur WHERE ID_vend=:id',array('id'=>$_POST['ID_vend']));
if(!empty($exist)){
	if(isset($_POST['modif'])){
		if(isset($_POST['mail'])){
			$_POST['mail'] = htmlspecialchars($_POST['mail']);// On rend inoffensives les balises HTML que le visiteur a pu rentrer
			if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$_POST['mail'])){
				$modif = $DB->emptyquery("UPDATE vendeur SET mail=:mail WHERE ID_vend=:id",array('id'=>$_POST['ID_vend'], 'mail'=>$_POST['mail']));
				die("Les données du vendeur ".$_POST['ID_vend']." ont bien été mise à jour. <a href='javascript:history.back()'>Retourner</a>");
			}
				die("Veuillez remplir correctement le mail. <a href='javascript:history.back()'>Retourner</a>");
		}
			
	}
	if(isset($_POST['suppr'])){
		$suppr = $DB->emptyquery('DELETE FROM vendeur WHERE ID_vend=:id',array('id'=>$_POST['ID_vend']));
		die("Le vendeur ".$_POST['ID_vend']." vient d'être supprimer. <a href='javascript:history.back()'>Retourner</a>");
	}
}else{

	die("Le compte vendeur ".$_POST['ID_vend']." n'existe pas. <a href='javascript:history.back()'>Retourner</a>");
}
?>