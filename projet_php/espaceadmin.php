<?php 
require'PHP/_header-DB.php';
require'header.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Espace Admin</title>
</head>
<body>
<div>Veuillez rafraichir la page à chaque changement(F5) ou <a href='espaceadmin.php'>cliquez ici</a></div>

<h1>Espace Admin</h1>
<?php $vendeurs = $DB->query('SELECT * FROM vendeur');?>
<h2>Gestion des Vendeurs</h2>
<?php foreach($vendeurs as $vendeur):?>
	<table>
		<th>ID</th>
		<th>mail</th>
		<form action="PHP/modifvendeur.php" method="post">
		<tr>
		<td><input type='text' name='ID_vend' value='<?php echo $vendeur->ID_vend;?>' readonly></td>
		<td><input type='text' name='mail' value='<?php echo $vendeur->mail;?>'></td>
		<td><input type='submit' name='modif' value='Modifier'></td>
		<td><input type='submit' name='suppr' value='Supprimer'></td>
		</tr>
		</form>
	</table>	
<?php endforeach ?>

<?php $pvendeurs = $DB->query('SELECT * FROM prevendeur');?>
<h2>Validation inscription Vendeur</h2>
<?php foreach($pvendeurs as $pvendeur):?>
	<table>
		<th>ID</th>
		<th>mail</th>
		<form action="PHP/validvend.php" method="post">
		<tr>
		<td><input type='text' name='ID_pvend' value='<?php echo $pvendeur->ID_pvend;?>' readonly></td>
		<td><input type='text' name='mail' value='<?php echo $pvendeur->mail;?>'></td>
		<td><input type='hidden' name='mdp_pvend' value='<?php echo $pvendeur->mdp_pvend;?>'></td>
		<td><input type='submit' name='valid' value='Valider'></td>
		</tr>
		</form>
	</table>	
<?php endforeach ?>
</body>
</html>