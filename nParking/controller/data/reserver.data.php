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

function reserverPlacePrecise($idm,$idp,$datepre){
    $d1 = date('U',strtotime($datepre))+24*60*60;
    $ddeb = date('Y-m-d',$d1);
    $d2 = $d1+7*24*60*60;
    $dfin = date('Y-m-d',$d2);
    $i = $GLOBALS["bdd"]->prepare("INSERT INTO reserver (date_fin_periode, id_membre, id_place, date_debut_periode) VALUES(?,?,?,?)");
    $i->execute(array($dfin,$idm,$idp,$ddeb));
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

function getProcheResaData(){
    $resa = $GLOBALS["bdd"]->prepare("SELECT id_place,date_fin_periode FROM reserver WHERE date_fin_periode IN (SELECT MIN(date_fin_periode) FROM reserver) AND date_fin_periode >= NOW() ");
    $resa->execute();
    return $resa;
}

function trierRangData(){
    $tri = $_GLOBALS["bdd"]->prepare("UPDATE membre SET rang = 0 WHERE id_membre IN (SELECT id_membre FROM reserver, membre WHERE membre.id_membre = reserver.id_membre AND rang>0 AND date_debut_periode<= NOW())");
}