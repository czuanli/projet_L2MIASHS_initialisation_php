<?php

session_start();
setcookie('se_souvenir', NULL, -1);
session_destroy();
$_SESSION['flash']['sucess']="Vous êtes maintenant déconnecté.";
header('location: login.php');


?>