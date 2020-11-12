<?php
require "PHP/_header-panier.php";
require "header.php";
logged();
?>


<?php
require_once"functions.php";
logged();
if(isset($_GET['del'])){
	$panier->del($_GET['del']);
}
?>
<html>
<head>
<meta charset='utf-8'>
<title>Panier</title>
<link rel="stylesheet" type="text/css" href="css/medicament.css">
<link rel="stylesheet" type="text/css" href="css/applyToAll.css">
<body>
	<h1>Panier</h1>
	<?php
		$ids = array_keys($_SESSION['panier']);
		if(empty($ids)){
			$produits = array();
		}else{
			$produits = $DB->query('SELECT * FROM objet WHERE ID_obj IN ('.implode(',',$ids).')');
		}
	?>
	<form method="post" action="panier.php">
	<table class="medicament">
		<?php foreach($produits as $produit):?>
		<tr>
		<td><img src="images/<?php echo $produit->nom_obj;?>.jpg" class="imgmedicament"></td>
		<td><?php echo $produit->nom_obj;?></td>
		<td><?php echo number_format($produit->prix_obj,2);?>€</td>
		<td><input type="number" name="panier[quantity][<?php echo $produit->ID_obj;?>]" 
			value="<?php echo $_SESSION['panier'][$produit->ID_obj];?>"></td>
		<td><a href="panier.php?del=<?php echo $produit->ID_obj;?>">Supprimer</a></td>
		</tr>
		<?php endforeach ?>
		<tr>
		<td colspan="6"><input type="submit" value="Recalculer"></td>
		<td>Total : <?php echo number_format($panier->total(),2);?></td>
		</tr>
	</table>
	</form>
	<div><a href="PHP/paiement.php">Payer</a></div>
</body>
</html>