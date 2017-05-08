<?php
include('data/attente.data.php');
include('controller/reserver.ctrl.php');

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
    $rs2 = getRangSuiv($r);
    $rss2 = $rs2->fetch();
    $rss1 = getReserver($idm);
    if($rss1["date_debut_periode"] != $rss2["date_debut_periode"] || $rss1["date_fin_periode"] != $rss2["date_fin_periode"]){
        echangeResa($idm, $rss2["id_membre"], $rss1["date_debut_periode"], $rss1["date_fin_periode"], $rss2["date_debut_periode"], $rss2["date_fin_periode"], $rss1["id_place"]);
    }
    plusData($r,$idm);
}

function moins($r,$idm){
    $rp2 = getRangPre($r);
    $rpp2 = $rp2->fetch();
    $rpp1 = getReserver($idm);
    if($rpp1["date_debut_periode"] != $rpp2["date_debut_periode"] || $rpp1["date_fin_periode"] != $rpp2["date_fin_periode"]){
        echangeResa($idm, $rpp2["id_membre"], $rpp1["date_debut_periode"], $rpp1["date_fin_periode"], $rpp2["date_debut_periode"], $rpp2["date_fin_periode"], $rpp1["id_place"]);
    }
    moinsData($r,$idm);
}

?>