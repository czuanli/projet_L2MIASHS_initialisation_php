<?php 
require 'PHP/_header-DB.php';
require 'header.php';

logged();

if(!empty($_POST)){

	if(empty($_POST['mdp']) || $_POST['mdp'] != $_POST['mdp_confirm']){
		$_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
	}

	else{

		$user_id = $_SESSION['auth']->ID_uti;
		$mdp= password_hash($_POST['mdp'], PASSWORD_BCRYPT);
		require_once'connexion_BDD.php';
		$requete = $pdo->prepare('UPDATE utilisateur SET mdp_uti = ? WHERE ID_uti = ?');

		$requete->execute([$mdp, $user_id]);

		$_SESSION['flash']['success'] = "Votre mot de passe a bien été pris en compte.";
	}	

}
?>
<html>
<head>
	<title>Mon compte</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Bonjour <?= $_SESSION['auth']->ID_uti; ?></h1>

	<p>Bienvenue sur votre page personnel !</p> 

	<?php

	$mdp_session_user=$_SESSION['auth']->mdp_uti;
	$ID_vend=$_SESSION['auth']->ID_uti;
	$requete = $DB->query("SELECT mdp_pvend FROM prevendeur WHERE ID_pvend=:id",array('id'=>$ID_vend));

	if ($mdp_session_user = $requete) {
			echo "Attente de validation de votre compte vendeur par l'admin";
	}
	
	$mdp_session_user=$_SESSION['auth']->mdp_uti;
	$ID_vend=$_SESSION['auth']->ID_uti;
	$requete = $DB->query("SELECT mdp_vend FROM vendeur WHERE ID_vend=:id",array('id'=>$ID_vend));

	if ($mdp_session_user = $requete) {
			echo '<a href="espacevendeur.php">Acc&#xE8;s vendeur</a>';
	}


	?>
	
	<h2>Changer votre mot de passe</h2>

	<form action="" method="POST">

		<div>

			<input type="password" name="mdp" placeholder="nouveau mot de passe"/>
		</div>

		<div>

				<input type="password" name="mdp_confirm" placeholder="Confirmation mot de passe"/>

		</div>

		<button> Changer mon mot de passe </button>

	</form>
	<?php 
	$hist = $DB->query("SELECT * FROM historique WHERE ID_uti=:id",array('id'=>$_SESSION['auth']->id));
	?>
	<h2>Historique d'achat</h2>
	<table>
		<?php $qte = utf8_encode("Quantité");?>
		<th>Vendeur</th>
		<th>Produit</th>
		<th><?php echo $qte;?></th>
		<th>Prix</th>
		<th>Date</th>
		<?php 
		foreach($hist as $hist):
			$ID_vend = $hist->ID_vend;
			$nom_obj = $hist->nom_obj;
			$nb_obj = $hist->nb_obj;
			$prix_obj = $hist->somme;
			$date = $hist->datep;
		?>
		<tr>
			<td><?php echo $ID_vend;?></td>
			<td><?php echo $nom_obj;?></td>
			<td><?php echo $nb_obj;?></td>
			<td><?php echo $prix_obj;?></td>
			<td><?php echo $date;?></td>
		</tr>
		<?php endforeach?>
	</table>
</body>
</html>