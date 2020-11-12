<?php
require("_header-panier.php");
header('Refresh: 5; http://p1web2020.metalman.eu/~groupeS/cai-wang/Session2_0/index.php');
?>
<?php
if(isset($_POST['valider'])){
	if(empty($_POST['numcarte']) OR empty($_POST['date']) OR empty($_POST['crypto'])){
		die("Veuillez remplir correctement tous les champs. <a href='javascript:history.back()'>Retourner</a>");
	}else{
		$produits = $_SESSION['panier'];
		$somme = $panier->total();
		foreach ($produits as $key=>$val) {
			$ID_obj = $key;
			$nom = $DB->query("SELECT nom_obj FROM objet WHERE ID_obj=:id",array('id'=>$ID_obj));
			$nom_obj = $nom[0]->nom_obj;
			$nb_obj = $val;
			$vendeur = $DB->query("SELECT ID_vend FROM objet WHERE ID_obj=:id",array('id'=>$ID_obj));
			$ID_vend = $vendeur[0]->ID_vend;
			$datep = date('Y-m-d H:i:s');
			$ID_uti=$_SESSION['auth']->id;
			$infohist = array($ID_obj, $ID_vend, $ID_uti, $nom_obj, $nb_obj, $datep, $somme);
			$hist = $DB->emptyquery("INSERT INTO historique (ID_obj, ID_vend, ID_uti, nom_obj, nb_obj, datep, somme) VALUES (?, ?, ?, ?, ?, ?, ?)", $infohist);
			$modifstock = $DB->emptyquery("UPDATE objet SET nb_obj=nb_obj-$val WHERE ID_obj=:id",array('id'=>$ID_obj));
			
		}
	die("La transaction a bien &#xE9;t&#xE9; effectu&#xE9;. Merci de votre confiance !  Vous allez &#xEA;tre rediriger dans 5s &#xE0; la page principale.");
}
}
?>
