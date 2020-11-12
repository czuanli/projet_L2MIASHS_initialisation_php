<?php
require '_header-DB.php';
?>
<?php

$pexist = $DB->query('SELECT * FROM vendeur WHERE ID_vend=:id',array('id'=>$_POST['ID_pvend']));
if(empty($pexist)){
	$infovend = array($_POST['ID_pvend'], $_POST['mdp_pvend'], $_POST['mail']);
	$ajout = $DB->emptyquery('INSERT INTO vendeur (ID_vend, mdp_vend, mail) VALUES (?, ?, ?)',$infovend);
	$suppr = $DB->emptyquery('DELETE FROM prevendeur WHERE ID_pvend=:id', array('id'=>$_POST['ID_pvend']));
	die("Le compte vendeur ".$_POST['ID_pvend']." est validé. <a href='javascript:history.back()'>Retourner</a>");
}else{
	die("Le compte vendeur existe déjà. <a href='javascript:history.back()'>Retourner</a>");
}

?>