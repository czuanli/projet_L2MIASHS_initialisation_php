<?php
require "PHP/_header-panier.php";
require "header.php";
?>
<!Doctype html>
<html>
<head>
	<title>Pharmacie de Tolbiac - Produits</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/medicament.css">
	<link rel="stylesheet" type="text/css" href="css/applyToAll.css">
</head>
<body>

	<div class="ndPartie">
		<table class="medicament">
			<!--Catégories-->
			<?php 
				$cat = $DB->query("SELECT cat_obj FROM objet");
			?>
			<th>Catégories : </th>
			<tr>
				<td><a href="produits.php">Tout</a></td>
			<?php foreach ($cat as $cat):?>
				<td><a href="?cat=<?php echo $cat->cat_obj; ?>"><?php echo $cat->cat_obj; ?></a></td>
			<?php endforeach ?> 
			</tr>
		</table>
		
		<fieldset class="medicament">
			<legend>Produits sans ordonnance</legend>
			<?php if(!isset($_GET['cat'])):?>
				<?php $produits = $DB->query('SELECT * FROM objet');?>
				<table>
				<?php foreach($produits as $produit):?>
					<tr><td>
					<div><a href="PHP/addpanier.php?ID_obj=<?php echo $produit->ID_obj;?>"><img src="images/<?php echo $produit->nom_obj;?>.jpg" class="imgmedicament"></a>
					<div><?php echo $produit->nom_obj;?><?php echo number_format($produit->prix_obj,2);?>€</div>
					<a href="PHP/addpanier.php?ID_obj=<?php echo $produit->ID_obj;?>">Ajout</a>
					</div>
					</td></tr>
				<?php endforeach ?>
				</table>
			<?php endif ?>
			<?php if(isset($_GET['cat'])):?>
				<?php $produits = $DB->query("SELECT * FROM objet WHERE cat_obj=:cats",array('cats'=>$_GET['cat']));?>
				<table>
				<?php foreach($produits as $produit):?>
					<tr><td>
					<div><a href="PHP/addpanier.php?ID_obj=<?php echo $produit->ID_obj;?>"><img src="images/<?php echo $produit->nom_obj;?>.jpg" class="imgmedicament"></a>
					<div><?php echo $produit->nom_obj;?><?php echo number_format($produit->prix_obj,2);?>€</div>
					<a href="PHP/addpanier.php?ID_obj=<?php echo $produit->ID_obj;?>">Ajout</a>
					</div>
					</td></tr>
				<?php endforeach ?>
				</table>
			<?php endif ?>
		</fieldset>
	</div>

	<script type="text/javascript" src="css/medicament.js"></script>
</body>
</html>