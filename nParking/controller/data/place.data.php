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

function addPlaces($num){
    $s = $GLOBALS["bdd"]->query("SELECT * FROM `place` ORDER BY `id_place` DESC LIMIT 1;");
    $d=$s->fetch();

    $der = $d["num_place"];

    for ($i=$der+1; $i <=$der+$num ; $i++) {
        echo $i;
        $add = $GLOBALS["bdd"]->prepare("INSERT INTO `place` (`num_place`,`active_place`) VALUES(?,1)");
        $add->execute(array($i));
    }
}

function acPlace($id){
    $ac = $GLOBALS["bdd"]->prepare("UPDATE `place` SET `active_place` = 1 WHERE `id_place` = ?");
    $ac->execute(array($id));
}

function deAcPlace($id){
    $ac = $GLOBALS["bdd"]->prepare("UPDATE `place` SET `active_place` = 0 WHERE `id_place` = ?");
    $ac->execute(array($id));
}

function getNbPlace(){
    $cplace = $GLOBALS["bdd"]->query("SELECT COUNT(*) as `total` FROM `place`");
    $count=$cplace->fetch();
    return ceil($count["total"]);
}

function getPlacesOfPage($prems,$total){
    $splace=$GLOBALS["bdd"]->prepare("SELECT * FROM `place` ORDER BY `num_place` LIMIT ?,?");
    $splace->execute(array($prems,$total));
    return $splace;
}

function getCountHist($id){
    $histcount = $GLOBALS["bdd"]->prepare("SELECT cOUNT(`id_place`) As `hcount` FROM `reserver` WHERE `id_place` = ?");
    $histcount->execute(array($id));
    $hc=$histcount->fetch();
    return $hc["hcount"];
}

?>