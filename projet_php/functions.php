<?php

function debug($variable){

	echo '<pre>'.print_r($variable, true).'</pre>';
}

function str_random($length){
	$alphabet ="0123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
	return substr(str_shuffle(str_repeat($alphabet,$length)), 0, $length);
}

function logged(){

	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}

	if(!isset($_SESSION['auth'])){

	$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
	header('location: login.php');
	exit();
	}

}

function reconnexion_cookie(){

	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}


	if(isset($_COOKIE['se_souvenir']) && !isset($_SESSION['auth'])){

		require_once 'connexion_BDD.php';

		if(!isset($pdo)){

			global $pdo;

		}

	global $pdo;

	$cookie_token = $_COOKIE['se_souvenir'];
	$parts = explode('==', $cookie_token);
	$user_id = $parts[0];
	$requete=$pdo->prepare('SELECT * FROM utilisateur WHERE id=?');
	$requete->execue([$user_id]);
	$user = $requete->fetch();
	if($user){

		$res = $user_id.'=='.$user->cookie_token.sha1($user_id->id.'mystere');
		if($res == $cookie_token){

			session_start();
			$_SESSION['auth'] = $user;
			setcookie('se_souvenir',$cookie_token,time() + 3600*24*7);
		}

	else{

			setcookie('se_souvenir', NULL, -1);
		}
	}

}

}


