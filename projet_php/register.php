<?php

session_start();

require 'header.php';

if(!empty($_POST)){


	$errors= array();
	require_once('connexion_BDD.php');
	

	if(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])){

		$errors['pseudo'] = "Votre pseudo n'est pas valide (alpha)";
	}

	else{

		$requete=$pdo->prepare('SELECT ID_uti FROM utilisateur WHERE ID_uti = ?');
		$requete->execute([$_POST['pseudo']]);

		$uti = $requete ->fetch();

			if($uti){
				$errors['pseudo'] = 'Ce pseudo est déjà pris';
			
			}


	}

	if(empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
		$errors['mail']="Votre mail n'est pas valide";
	}

	else{

			$requete=$pdo->prepare('SELECT mail FROM utilisateur WHERE mail = ?');
			$requete->execute([$_POST['mail']]);

			$uti = $requete ->fetch();

				if($uti){
					$errors['mail'] = 'Cet email est déjà utilisé pour un autre compte';
				
				}


		}

	if(empty($_POST['mdp']) || $_POST['mdp'] != $_POST['mdp2']){

		$errors['mdp'] = "Vous devez rentrer un mot de passe valide";
	}

	if (empty($errors)){

			
			$type_sessions=$_POST['type_sessions'];

			$res="";
				foreach ($type_sessions as $v1) {
			        $res=$res."$v1";
		    }

			if($res==="uti"){

		        $requete= $pdo->prepare("INSERT INTO utilisateur SET  ID_uti = ?, mdp_uti=?, adr_uti = ?, mail = ?, confirmation_token = ?");

		        $mdp_hash = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

		        $token= str_random(60);

		        $requete->execute([$_POST['pseudo'], $mdp_hash, $_POST['adr'], $_POST['mail'], $token]);

		        $uti_id=$pdo->lastInsertId();

		        mail($_POST['mail'], 'Confirmation de votre compte',"Afin de valider votre compte merci de cliquer sur ce lien \n\nhttp://localhost/Session2_0/confirm.php?id=$uti_id&token=$token");

		        $_SESSION['flash']['success']="Un email de confirmation vous a été envoyé pour valider votre compte. ";
		        header('location: login.php');

		        exit();
    		}

			
			else{

				$requete_vendeur=$pdo->prepare("INSERT INTO prevendeur SET ID_pvend = ?, mdp_pvend=?, mail=?");
		        
		        $requete= $pdo->prepare("INSERT INTO utilisateur SET  ID_uti = ?, mdp_uti=?, adr_uti = ?, mail = ?, confirmation_token = ?");

		        $mdp_hash = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

		        $token= str_random(60);

		        $requete->execute([$_POST['pseudo'], $mdp_hash, $_POST['adr'], $_POST['mail'], $token]);

		        $requete_vendeur->execute([$_POST['pseudo'], $mdp_hash,$_POST['mail']]);

		        $uti_id=$pdo->lastInsertId();

		        mail($_POST['mail'], 'Confirmation de votre compte',"Afin de valider votre compte merci de cliquer sur ce lien \n\nhttp://p1web2020.metalman.eu/~groupeS/cai-wang/Session2_0/confirm.php?id=$uti_id&token=$token");

		        $_SESSION['flash']['success']="Un email de confirmation vous a été envoyé pour valider votre compte.\n 
							Si vous n'avez pas re&#xE7;u le mail, c'est peut &#xEA;tre d&#xFB; &#xE0; une mauvaise config de sendmail.\n
							Dans ce cas ci : veuillez copier le lien suivant :
							http://p1web2020.metalman.eu/~groupeS/cai-wang/Session2_0/confirm.php?id=$uti_id&token=$token  \n
							avec une modification de $uti_id qui a pour valeur l'id de l'utilisateur r&#xE9;cup&#xE9;rer dans la BDD et $token a pour valeur le confirmation_token de l'utilisateur dans la BDD";



			header('location: login.php');

		        exit();

	    	}
    	
    }  
	
}
?>
<html>
<head>
	<title>S'inscrire</title>
	<meta charset="utf-8">
</hea>
<body>
<h1>Bienvenue dans la Famille de la Pharmacie de Tolbiac!</h1> 
<h3>Si vous souhaitez devenir vendeur chez nous, nous vous prions de bien vouloir vous inscrire en cochant l'option vendeur"</h3>
<h7>Lors de l'inscription, il se pourrait que vous ne puissiez pas valider le mail d'inscription. Si cas pr&#xE9;c&#xE9;dent : veuillez copier le lien suivant :
http://p1web2020.metalman.eu/~groupeS/cai-wang/Session2_0/confirm.php?id=$uti_id&token=$token <br>
avec une modification de $uti_id qui a pour valeur l'id de l'utilisateur recuperer dans la BDD et $token a pour valeur le confirmation_token de l'utilisateur dans la BDD</h7>


<?php  if(!empty($errors)): ?>

	<div class= "alert alert-danger">
		<p>Vous n'avez pas rempli le formulaire correctement</p>
			<ul>
				
				<?php foreach($errors as $error): ?>
					
					<li><?= $error; ?></li>
				
				<?php endforeach; ?>
			</ul>
	</div>	
<?php endif; ?>

<form action="" method="POST">
		<table>
			<tr>
				<td><label>Pseudo</label></td>
				<td><input type="text" name="pseudo"></td>
			</tr>

			<tr>
				<td><label>Adresse mail</label></td>
				<td><input type="text" name="mail"></td>
			</tr>
			<tr>
				<td><label>Mot de passe</label></td>
				<td><input type="password" name="mdp"></td>
			</tr>

			<tr>
				<td><label>Confirmez votre mot de passe</label></td>
				<td><input type="password" name="mdp2"></td>
			</tr>

			<tr>
				<td><label>Adresse</label></td>
				<td><input type="text" name="adr"></td>
			</tr>


			<tr>

				<td><label>Je souhaite m'inscrire en temps que :</label></td>
				<td><label><input type="checkbox" name="type_sessions[]" value="vend">Vendeur</label></td>
				<td><label><input type="checkbox" name="type_sessions[]" value="uti" required>Utilisateur</label></td>

			</tr>

			<tr>
				<td><input type="submit" name="Créer un compte"> <input type="reset" name="Annuler"></td>
			</tr>
		</table>
	</form>
</body>
</html>