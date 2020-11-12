<?php
require("_header-panier.php");

$ids = array_keys($_SESSION['panier']);

if(empty($ids)){
	$stock = array();
}else{
	$stock = $DB->query('SELECT nb_obj FROM objet WHERE ID_obj IN ('.implode(',',$ids).')');
	$nom = $DB->query('SELECT nom_obj FROM objet WHERE ID_obj IN ('.implode(',',$ids).')');
}

$count = 0;

foreach ($_SESSION['panier'] as $qte) {
	if($qte<=0){
		die("Veuillez entrer une quantite valide de produits. <a href='javascript:history.back()'>Retourner</a>");
	}
	if($qte>$stock[$count]->nb_obj){
		$reste = $stock[$count]->nb_obj;
		$nomreste = $nom[$count]->nom_obj;
		die("Vous avez choisi $qte de $nomreste et il ne reste que $reste du produit $nomreste. <a href='javascript:history.back()'>Retourner</a>");
	}
	$count +=1;

}
?>
<html>
<head>
	<title>Paiement</title>
	<meta charset="utf-8">
</head>
<body>
<div><a href='javascript:history.back()'>Retourner</a><div>
	<h1>Paiement</h1>
	<table>
		<th colspan="2">Total : <?php echo $panier->total();?>€</th>
		<form action="paye.php" method="post">
		<tr>
			<td>Numéros de carte : </td>
			<td><input type="number" name="numcarte"></td>
		</tr>
		<tr>
			<td>Date de fin d'expiration : </td>
			<td><input type="date" name="date"></td>
		</tr>
		<tr>
			<td>Cryptogramme visuel : </td>
			<td><input type="number" name="crypto"></td>
		</tr>
		<tr>
			<td><input type="submit" name="valider" value="Valider"></td>
		</tr>
		</form>
	</table>
</body>
</html>