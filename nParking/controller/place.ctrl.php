<?php
include("data/place.data.php");

function getPlaceMembre($id){
	$d = getPlaceMembreDataCount($id);
	if($d > 0){
		$data = getPlaceMembreData($id);
		$place = $data->fetch();
		return $place["num_place"];
	}
	else{
		return null;
	}
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
    $splace->(array($prems,$total));
    return $splace;
}

function getCountHist($id){
    $histcount = $GLOBALS["bdd"]->prepare("SELECT cOUNT(`id_place`) As `hcount` FROM `reserver` WHERE `id_place` = ?");
    $histcount->execute(array($id));
    $hc=$histcount->fetch();
    return $hc["hcount"];
}


?>