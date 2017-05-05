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


//// A FAIRE

function getPlacesOfPage($prems,$total){
    $place = getPlacesOfPageData($prems,$total);
    $affichPlace = array();
    $i=0;
    while($data = $place->fetch()){
        $affichPlace [$i] = array($data["id_place"], $data["num_place"]);
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