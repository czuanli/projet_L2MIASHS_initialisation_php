<?php 

if(session_status() == PHP_SESSION_NONE){
	session_start();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="site_css.css">

</head>
<body>

<table class="tablemenu">
		<tr>
		<td>
		<!--Menu-->
		<ul class = menu>
			<!--Page affichée pour l'utilisateur connecté-->
			<?php if(isset($_SESSION['auth'])): ?>

				<html>
					<head>
					<meta charset='utf-8'>
					<title>Connexion</title></head>
					<link rel="stylesheet" type="text/css" href="css/medicament.css">
					<link rel="stylesheet" type="text/css" href="css/applyToAll.css">
					<body>
					<img class="logo" src="images/logo4.jpg">
						<!--Menu-->
						<table class="tablemenu">
						<tr>
						<td>
						<ul class = menu>
							<li><a href="index.php">Accueil</a></li>
							<li><a href="produits.php">Produits</a></li>
							<li><a href="panier.php">Panier</a></li>
							<li><a href="aPropos.php">A propos</a></li>
							<li><a href="account.php">Mon compte</a></li>
							<li><a href="logout.php">Déconnexion</a></li>
						</ul></td>
						</tr>
						</table>
					</body>
					</html>

			<?php else: ?>
				<html>
					<head>
					<meta charset='utf-8'>
					<title>Connexion</title></head>
					<link rel="stylesheet" type="text/css" href="css/medicament.css">
					<link rel="stylesheet" type="text/css" href="css/applyToAll.css">
					<body>
					<img class="logo" src="images/logo4.jpg">
						<!--Menu-->
						<table class="tablemenu">
						<tr>
						<td>
						<ul class = menu>
							<li><a href="index.php">Accueil</a></li>
							<li><a href="produits.php">Produits</a></li>
							<li><a href="aPropos.php">A propos</a></li>
							<li><a href="register.php">S'inscrire</a></li>
							<li><a href="login.php">Se connecter</a></li>
						</ul></td>
						</tr>
						</table>
					</body>
					</html>
				
		<?php endif;?>
		</ul></td>
		</tr>
</table>


<?php include('functions.php'); ?>

<?php if(isset($_SESSION['flash'])): ?>
	
	<?php foreach ($_SESSION['flash'] as $type => $message): ?>
	
		<div class="alert alert-<?= $type; ?>">
	
			<?= $message; ?>
		
		</div>
	
	<?php endforeach; ?>
	
	<?php unset($_SESSION['flash']);?>

<?php endif;?>

</body>
</html>
