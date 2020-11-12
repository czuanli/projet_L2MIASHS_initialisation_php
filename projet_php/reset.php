<?php

if(isset($_GET['id']) && isset($_GET['token'])){

	require 'connexion_BDD.php';
	require 'functions.php';
	$requete=$pdo->prepare('SELECT * FROM utilisateur WHERE id = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
	$requete->execute($_GET['id'], $_GET['token']);

	$user=$requete->fetch();
	if($user){

		if(!empty($_POST)){

			if(!empty($_POST['mdp']) && $_POST['mdp'] == $_POST['mdp_confirm']){

				$mdp_hash = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

				$pdo->prepare('UPDATE utilisateur SET mdp_uti = ?, reset_at= NULL, reset_token = NULL ')->execute([$mdp_confirm]);
				session_start();
				$_SESSION['flash']['success']='Votre mot de passe a bien été modifié';
				$_SESSION['auth']=$user;
				header('location: account.php');
				exit();

			}

		}

	}
	else{

		session_start();
		$_SESSION['flash']['error']="Ce lien n'est pas valide";

		header('location: login.php');

		exit();
	}
}
else{

	header('location: login.php');
	exit();

}

?>

<?php require 'header.php';?>

<?php  ?>

<h1>Réinitialiser mon mot de passe</h1>

<form action="" method="POST">

	<div class="form-group">
				<label for="">Mot de passe <a href="forget.php"></a></label>
				<input type="password" name="mdp" class="form-control">
				
	</div>

	<div class="form-group">
				<label for="">Confirmation du mot de passe <a href="forget.php"></a></label>
				<input type="password" name="mdp_confirm" class="form-control">
				
	</div>

	<button tupe="sumit class="btn btn-primary">Réinitialiser mon mot de passe</button>

	</form>

?>