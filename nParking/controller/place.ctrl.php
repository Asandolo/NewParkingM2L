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

?>