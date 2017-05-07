<?php
include("data/reserver.data.php");

function getHistoriqueMembre($id){
	$h = historiqueData($id);
	$i = 0;
	$historique = array();
	while($data = $h->fetch()){
		$historique [$i] = array(
			"date_debut_periode" => $data["date_debut_periode"],
			"date_fin_periode" => $data["date_fin_periode"],
			"num_place" => $data["num_place"]
			);
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

function reserver($idm){
    $c = getcountPd();
    if ($c>0){
        $places = getPlaceDispo();
        $place = $places[0];
        reserverPlace($idm,$place["id_place"]);

    }else{
        $r = getMaxRang();
        $r++;
        reserverPlace($idm,$r);
    }
}

function setRang($idm){
    $r = getMaxRang();
    $r++;
    reserverRang($idm,$r);
    $resa = getProcheResaData();
    reserverPlacePrecise($idm,$resa["id_place"],$resa["date_fin_periode"]);
}

function getProcheResa(){
    return getProcheResa();
}

function getcountPd(){
 return countPd();
}


function getplaceDispo(){
    $s = selectPlaceDispo();
    $array = array();
    $i=0;
    while ($d=$s->fetch()){
        $array[$i] = array(
            "id_place" => $d["id_place"],
            "num_place" => $d["num_place"]
        );
        $i++;
    }
    return $array;
}
?>