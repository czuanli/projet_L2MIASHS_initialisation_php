<?php 

require_once 'header.php';
reconnexion_cookie();

//authentification réussie, redirection vers la page compte de l'utilisateur
if(isset($_SESSION['auth'])){

	header('location: account.php');

	exit();

}

//Vérification des données saisies lors de l'authentification avec la BDD

if(!empty($_POST) && !empty($_POST['ID_uti']) && !empty($_POST['mdp'])){
    
    require_once 'connexion_BDD.php';
    
    // vérif pour admin

    if('Admin'==$_POST['ID_uti']){

    	if($_POST['mdp']=='codeAdmin'){

    	$_SESSION['auth'] = $user;

	    $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';

	    header('location: espaceadmin.php');
    	}

    }

    //vérif pour les utilisateurs
    
    
	    $requete = $pdo->prepare('SELECT * FROM utilisateur WHERE (ID_uti = :ID_uti OR mail = :ID_uti) AND confirmed_at IS NOT NULL');
	    
	    $requete->execute([':ID_uti' => $_POST['ID_uti']]);
	    
	    $user = $requete->fetch();

		    	if(password_verify($_POST['mdp'], $user->mdp_uti)){
		    	
		        $_SESSION['auth'] = $user;

		        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';

			        if($_POST['se_souvenir']){

			        	$cookie_token = str_random(255);
			        	
			        	$pdo->prepare('UPDATE utilisateur SET cookie_token = ? WHERE id = ?')->execute([$cookie_token, $user->id]);
			        	setcookie('se souvenir',$user->id.'=='.$cookie_token.sha1($user->id.'mystere'), time()*3600*24*7);

			        }

			        header('location: account.php');

			        exit();
			    }

		   		 else{
		        	
		        	$_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
		    	
		    	}
	    
}

?>


<h1>Se connecter</h1>

<form action="" method="POST">

			<table>
				<tr>
					<td>Pseudo ou Email</td>
					<td><input type="text" name="ID_uti"></td>
				</tr>

			<tr>
				<td>Mot de passe <a href="forget.php">(J'ai oublié mon mot de passe)</a></td>
				<td><input type="password" name="mdp" class="form-control"></td>
			</tr>

			<tr>
				<td><input type="checkbox" name="se_souvenir" value="1"/>Se souvenir de moi</td>
			</tr>

			<tr><td><button type="submit">Se connecter</button> <input type="reset" name="Annuler"></td></tr>
			
	</form>
