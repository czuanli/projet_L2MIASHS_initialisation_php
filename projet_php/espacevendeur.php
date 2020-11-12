<?php 
require'PHP/_header-DB.php';
require 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Espace Vendeur</title>
</head>
<body>
<div>Veuillez rafraichir la page à chaque modification de donn&#xE9;es(F5) ou <a href='espacevendeur.php'>cliquez ici</a></div>
<h1>Espace Vendeur</h1>
<h2>Produits mises en vente</h2>
<?php 

	$produits = $DB->query('SELECT * FROM objet WHERE ID_vend=:vend',array('vend'=> $_SESSION['auth']->ID_uti));

	if(empty($produits)){
		echo "Vous n'avez pas de produit mise en ligne"; 
	}

	if(!empty($produits)):
?>
	<table>
		<th>ID</th>
		<th>nom</th>
		<th>catégorie</th>
		<th>prix</th>
		<th>Quantité</th>
		<?php foreach($produits as $produit):?>
		<form action="PHP/modifproduit.php" method="post">
		<tr>
		<td><div><input type='number' name='ID_obj' value='<?php echo $produit->ID_obj;?>' readonly></div></td>
		<td><div><input type='text' name='nom_obj' value='<?php echo $produit->nom_obj;?>'></div></td>
		<td><div><input type='text' name='cat_obj' value='<?php echo $produit->cat_obj;?>'></div></td>
		<td><div><input type='text' name='prix_obj' value='<?php echo number_format($produit->prix_obj, 2, '.','');?>'>€</div></td>
		<td><div><input type='number' name='nb_obj' value='<?php echo $produit->nb_obj;?>'></div></td>
		<td><input type='submit' name='modif' value='Modifier'></td>
		<td><input type='submit' name='suppr' value='Supprimer'></td>
		</tr>
		</form>
		<?php endforeach ?>
	</table> 	
	<?php endif?>

<h2>Ajouter un Nouveau Produit</h2>
<form action="PHP/ajoutproduit.php" method="post">
<table>
<tr>
	<td><label>ID produit : </label></td>
	<td><input type="number" name="ID_obj"></td>
</tr>
<tr>
	<td><label>Nom produit : </label></td>
	<td><input type="text" name="nom_obj" maxlength="255"></td>
</tr>
<tr>
	<td><label>Prix : </label></td>
	<td><input type="text" name="prix_obj" maxlength="10"></td>
</tr>
<tr>
	<td><label>Catégorie : </label></td>
	<td><input type="text" name="cat_obj"></td>
</tr>
<tr>
	<td><label>Quantité : </label></td>
	<td><input type="number" name="nb_obj"></td>
</tr>
<tr>
	<td><input type="hidden" name="ID_vend" value="<?php echo $_SESSION['auth']->ID_uti?>"></td>
</tr>
</table>
<button type="submit">Soumettre</button>
<button type="reset">Restaurer</button>
</form>
</body>
</html>