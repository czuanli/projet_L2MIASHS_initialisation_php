<?php
class panier{
	//envoyer la bd au panier lorsqu'on l'initialise 
	private $DB;
	//verif de l'existence du panier, sinon on le créer
	public function __construct($DB){
		if(!isset($_SESSION)){
			session_start();
		}
		
		if(!isset($_SESSION['panier'])){
			//initiation du panier
			$_SESSION['panier']=array();
		}
		$this->DB = $DB;

		if(isset($_POST['panier']['quantity'])){

			$ids = array_keys($_SESSION['panier']);

			if(empty($ids)){
				$stock = array();
			}else{
				$stock = $this->DB->query('SELECT nb_obj FROM objet WHERE ID_obj IN ('.implode(',',$ids).')');
				$nom = $this->DB->query('SELECT nom_obj FROM objet WHERE ID_obj IN ('.implode(',',$ids).')');
			}
		
			$count = 0;

			foreach (array_values($_POST['panier']['quantity']) as $qte) {
				if($qte>$stock[$count]->nb_obj){
					$reste = $stock[$count]->nb_obj;
					$nomreste = $nom[$count]->nom_obj;
					die("Vous avez choisi $qte de $nomreste et il ne reste que $reste du produit $nomreste. <a href='javascript:history.back()'>Retourner</a>");
				}
				$count +=1;
			
			}

			foreach ($_POST['panier']['quantity'] as $key => $value) {
				if($value<=0){
					die("Veuillez entrer une quantite valide de produits. <a href='javascript:history.back()'>Retourner</a>");
				}
			}
			$this->recalc();
		}
	}
	//modification de quantité de produits
	public function recalc(){
		$_SESSION['panier'] = $_POST['panier']['quantity'];
	}
	
	//fonction d'ajout de produit dans le panier
	public function add($id_produit){
		if(isset($_SESSION['panier'][$id_produit])){
			$_SESSION['panier'][$id_produit]++;
		}else{
			$_SESSION['panier'][$id_produit] = 1;
		}
	}
	
	//fonction de suppression des produits dans le panier
	public function del($id_produit){
		unset($_SESSION['panier'][$id_produit]);
	}
	
	//fonction total
	public function total(){
		$total = 0;
		$ids = array_keys($_SESSION['panier']);
		if(empty($ids)){
			$produits = array();
		}else{
			//les ID et prix des produits avec les ID_obj de $ids
			$produits = $this->DB->query('SELECT ID_obj, prix_obj FROM objet WHERE ID_obj IN ('.implode(',',$ids).')');
		}
		foreach($produits as $produit){
			$total += ($produit->prix_obj)*($_SESSION['panier'][$produit->ID_obj]);
		}
		return $total;
	}
}
?>