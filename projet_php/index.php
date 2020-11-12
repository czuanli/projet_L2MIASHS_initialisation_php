<?php 
require('header.php');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Pharmacie de Tolbiac - Accueil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/accueil.css">
	<link rel="stylesheet" type="text/css" href="css/applyToAll.css">
</head>
<body>
		<div class="imgPrin">
  			<img class="mySlides" id="Slide1" src="images/pharm.jpeg">
  			<img class="mySlides" id="Slide2" src="images/pharm2.jpeg">
  			<img class="mySlides" id="Slide3"src="images/pharm3.jpeg">
  			<img class="mySlides" id="Slide4" src="images/pharm4.jpeg">
		</div>
  		<div class="imgSection">
    		<table class="imgSection">
      			<tr>
        			<td><img id="imgop" class="point opaque" src="images/pharm.jpeg" onclick="currDiv(1)"></td>
        			<td><img id="imgop"  class="point opaque" src="images/pharm2.jpeg" onclick="currDiv(2)"></td>
      				<td><img id="imgop" class="point opaque" src="images/pharm3.jpeg" onclick="currDiv(3)"></td>
      				<td><img id="imgop" class="point opaque" src="images/pharm4.jpeg"onclick="currDiv(4)"></td>
    		</table>
  		</div>

	<div class ="headerSite" >
		<table>
			<thead><th>Bienvenue dans notre pharmacie</th></thead>
			<tr>
				<td class = "texteDeBienvenue">
				
				<div class="quote">
				<p class="slogan">
				Tout à prix imbattable toute l'année !<br>
				Oubliez les autres pharmacies du monde <br>
				Les meilleurs offres, c'est chez nous: <br>
				Brillant, galant, aimant, bienveillant, <br>
				Intègre, bon,  <br>
				A l'écoute des jeunes comme des seniors, <br>
				Coût bas .<br>
				</p></div>
				<p>
				Le TD 2 vous accueille sur le site internet de la pharmacie, vous donnant accès à tous nos services 
				en ligne et prise de contact avec nous.</p>
				<p>
				La Pharmacie de Tolbiac a été créée en 2019 par le TD2 pour les étudiants. 
				Nous vous certifions la qualité de nos produits (médicaments, diététiques, cosmétiques,...). 
				Nous vous assurons les meilleurs prix et un service par des pharmaciens experts dans leurs spécialités.</p>
				<p>
				Notre équipe est là pour vous garantir le meilleur des accueils du lundi matin au samedi 
				dans notre Pharmacie afin de répondre à tous vos besoins.</p>

				</td>
				</tr>
		</table>
	</div>
	<br>
	<div class ="Promotions">
		<table>
			<thead>
				<th>Promotions</th>
			</thead>
			<tr>
				<td class="textPromo"> Pas de promotion actuellement</td>
			</tr>
		</table>
	</div>

	<script src="js/accueil.js"></script>
<footer class="footer">
		<p><img class="logofooter" src="images/logo.jpg"> Tous droits réservés Zerui et Zuanli TD2 2020  © </p>	
</footer>	
</body>
</html>