<?php


$uti_id=$_GET['id'];

$token=$_GET['token'];

require'connexion_BDD.php';

$requete=$pdo->prepare('SELECT * FROM utilisateur WHERE id = ?');

$requete->execute([$uti_id]);

$user=$requete->fetch();

session_start();

if($user && $user->confirmation_token==$token){

	
	$pdo->prepare('UPDATE utilisateur SET confirmation_token = NULL, confirmed_at=NOW() WHERE id = ?')->execute([$uti_id]);
	
	$_SESSION['flash']['success']="Votre compte a bien été validé. ";

	
	$_SESSION['auth']=$user;

	header('location: account.php');

}
else{

	$_SESSION['flash']['danger']="Ce lien n'est plus valide";

	header('location: login.php');
}
?>