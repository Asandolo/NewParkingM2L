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

function acPlace($id){
    acPlaceData($id);
}


function deAcPlace($id){
    deAcPlaceData($id);
}

function getNbPlace(){
    return getNbPlaceData();
}

function getPlacesOfPage($prems,$total){
    $place = getPlacesOfPageData($prems,$total);
    $affichPlace = array();
    $i=0;
    while($data = $place->fetch()){
       $affichPlace [$i] = array("id_place" => $data["id_place"], "num_place" => $data["num_place"], "active_place" => $data["active_place"]);
       $i++;
    }
    return $affichPlace;
}

function haveBeenReserve($id){
    if(getCountHistData($id) <=0){
        return false;
    }
    
    return true;
}

function getHistoriquePlace($id){
    $s = selectPLaceHist($id);
    $array = array();
    $i=0;
    while ($d=$s->fetch()){
        $array[$i] = array(
            "num_place" => $d["num_place"],
            "nom_membre" => $d["nom_membre"],
            "prenom_membre" => $d["prenom_membre"],
            "date_fin_periode" => $d["date_fin_periode"],
            "date_debut_periode" => $d["date_debut_periode"],
            "active_place" => $d["active_place"]
        );
        $i++;
    }
    return $array;
}

function addPlaces($num){
    addPlacesData($num);
}

function getCHPlace($id){
    return selectCPLaceHist($id);
}

?>