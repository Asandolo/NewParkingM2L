<?php
include('data/attente.data.php');
function getAttente(){
    $att =  getAttenteData();
    $array = array();
    $i = 0;
    while ($data = $att->fetch()){
        $array[$i] = array(
            "id_membre" => $data["id_membre"],
            "nom_membre" => $data["nom_membre"],
            "prenom_membre" => $data["prenom_membre"],
            "rang" => $data["rang"]
        );
        $i++;
    }
    return $array;

}

function getCompt(){
    return getComptData();
}

function getMax(){
    return getMaxData();
}

function plus($r,$idm){
    plusData($r,$idm);
}

function moins($r,$idm){
    moinsData($r,$idm);
}

?>