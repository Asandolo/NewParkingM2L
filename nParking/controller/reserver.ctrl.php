<?php
include("data/reserver.data.php");

function getHistoriqueMembre($id){
	$h = historiqueData($id);
	$i = 0;
	$historique = array();
	while($data = $h->fetch()){
		$historique = array($i => array(
			"date_debut_periode" => $data["date_debut_periode"],
			"date_fin_periode" => $data["date_fin_periode"],
			"num_place" => $data["num_place"]
			));
		$i++;
	}
	return $historique;
}

function getReserver($id){
	$place = placeActuelMembre($id);
	$p = $place->fetch();
	$arPlace = array(
		"date_debut_periode" => $p["date_debut_periode"],
		"date_fin_periode" => $p["date_fin_periode"],
		"num_place" => $p["num_place"]
	);
	return $arPlace;
}
?>