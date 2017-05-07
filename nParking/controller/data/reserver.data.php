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

function selectPlaceDispo(){
    $week = date("U")+7*24*60*60;
    $w = date("Y-m-d",$week);
    $select = $GLOBALS["bdd"]->prepare("SELECT * FROM place WHERE active_place = 1 AND id_place NOT IN (SELECT reserver.id_place FROM reserver WHERE date_fin_periode <= ? AND date_debut_periode<NOW())");
    $select->execute(array($w));
    return $select;
}

function countPd(){
    $week = date("U")+7*24*60*60;
    $w = date("Y-m-d",$week);
    $select = $GLOBALS["bdd"]->prepare("SELECT COUNT(*) As c FROM place WHERE active_place = 1 AND id_place NOT IN (SELECT reserver.id_place FROM reserver WHERE date_fin_periode <= ? AND date_debut_periode<NOW())");
    $select->execute(array($w));
    $d=$select->fetch();
    return $d["c"];
}

function reserverPlace($idm,$idp){
    $week = date("U")+7*24*60*60;
    $w = date("Y-m-d",$week);
    $i = $GLOBALS["bdd"]->prepare("INSERT INTO reserver (date_fin_periode, id_membre, id_place, date_debut_periode) VALUES(?,?,?,NOW())");
    $i->execute(array($w,$idm,$idp));
}

function reserverRang($idm,$rang){
    $u = $GLOBALS["bdd"]->prepare("UPDATE membre SET rang = ? WHERE id_membre = ?");
    $u->execute(array($rang,$idm));
}

function getMaxRang(){
    $s = $GLOBALS["bdd"]->query("SELECT MAX(rang) as d FROM membre");
    $d=$s->fetch();
    return $d["d"];
}