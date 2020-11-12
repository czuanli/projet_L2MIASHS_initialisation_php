<?php 
if(!empty($_POST) && !empty($_POST['email'])){
    require_once 'connexion_BDD.php';
    require 'functions.php';

    $req = $pdo->prepare('SELECT * FROM utilisateur WHERE (mail = ?) AND confirmed_at IS NOT NULL');
    
    $req->execute([$_POST['email']]);
    $user = $req->fetch();
	    if($user){
	    	session_start(); 

	    	$reset_token = str_random(60);
	    	$pdo->prepare('UPDATE utilisateur SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
	    	$_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par mail';

	    	mail($_POST['email'], 'Réinitialisation de votre compte',"Afin de réinitialiser votre compte merci de cliquer sur ce lien \n\nhttp://localhost/test/reset.php?id={$user->id}&token=$reset_token");


	    	header('location: login.php');
	    	exit();

}

else{
	$_SESSION['flash']['danger']='Aucun compte ne correspond à cet adresse';
}

}
?>


<?php require 'header.php';?>

<?php  ?>

<h1>Mot de passe oublié</h1>

<form action="" method="POST">

	<div class="form-group">
				<label for="">Email</label>
				<input type="email" name="email" class="form-control"/>
			
	</div>
			<button tupe="submit" class="btn btn-primary">Se connecter</button>
</form>