<?php
include("config/db.php");

function historiqueData($id){
	$aujourdhui = date("Y-m-d");
	$historique = $GLOBALS["bdd"]->prepare("SELECT reserver.id_membre,reserver.id_place,num_place,date_debut_periode,date_fin_periode FROM membre, place, reserver WHERE membre.id_membre = reserver.id_membre AND place.id_place=reserver.id_place AND reserver.id_membre=? AND reserver.date_debut_periode <= ? ORDER BY date_fin_periode DESC LIMIT 0,2");
	$historique->execute(array($id,$aujourdhui));
	return $historique;
}

function placeActuelMembre($id){
	$aujourdhui = date("Y-m-d");
	$places = $GLOBALS["bdd"]->prepare("SELECT * FROM reserver, place WHERE reserver.id_place = place.id_place AND id_membre = ? AND date_fin_periode >= ?");
	$places->execute(array($id,$aujourdhui));
	return $places;
}