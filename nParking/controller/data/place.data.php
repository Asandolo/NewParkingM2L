<?php
include("config/db.php");


function getPlaceMembreData($id){
	$ajd = date("Y-m-d");
	$places = $GLOBALS["bdd"]->prepare("SELECT * FROM place,reserver WHERE place.id_place = reserver.id_place AND id_membre= ? AND date_fin_periode>?");
	$places->execute(array($id,$ajd));
	return $places;
}

function getPlaceMembreDataCount($id){
	$ajd = date("Y-m-d");
	$places = $GLOBALS["bdd"]->prepare("SELECT COUNT(*) As c FROM place,reserver WHERE place.id_place = reserver.id_place AND id_membre= ? AND date_fin_periode>?");
	$places->execute(array($id,$ajd));
	$d =$places->fetch();
	return $d["c"];
}

?>