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


?>