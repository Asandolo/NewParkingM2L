<?php
include('config/db.php');

function getAttenteData(){
    $srang = $GLOBALS["bdd"]->query("SELECT * FROM `membre` WHERE `rang` > 0 ORDER BY `rang` ASC;");
    return $srang;
}

function getComptData(){
    $srang = $GLOBALS["bdd"]->query("SELECT * FROM `membre` WHERE `rang` > 0 ORDER BY `rang` ASC;");
    return $srang->rowCount();
}

function getMaxData(){
    $srang = $GLOBALS["bdd"]->query("SELECT MAX(rang) As r FROM `membre`;");
    $d = $srang->fetch();
    return $d["r"];
}

function plusData($r,$idm){
    $sp = $GLOBALS["bdd"]->prepare("SELECT * FROM `membre` WHERE `rang` = ?");
    $sp->execute(array($r+1));
    $dsp=$sp->fetch();

    $r1=$GLOBALS["bdd"]->prepare("UPDATE `membre` SET `rang` = ? WHERE `id_membre` = ?");
    $r1->execute(array($r+1,$idm));

    $r2=$GLOBALS["bdd"]->prepare("UPDATE `membre` SET `rang` = ? WHERE `id_membre` = ?");
    $r2->execute(array($dsp["rang"]-1,$dsp["id_membre"]));
}

function moinsData($r,$idm){
    $sp = $GLOBALS["bdd"]->prepare("SELECT * FROM `membre` WHERE `rang` = ?");
    $sp->execute(array($r-1));
    $dsp=$sp->fetch();

    $r1=$GLOBALS["bdd"]->prepare("UPDATE `membre` SET `rang` = ? WHERE `id_membre` = ?");
    $r1->execute(array($r-1,$idm));

    $r2=$GLOBALS["bdd"]->prepare("UPDATE `membre` SET `rang` = ? WHERE `id_membre` = ?");
    $r2->execute(array($dsp["rang"]+1,$dsp["id_membre"]));
}

function getRangSuiv($r){
    $rs = $GLOBALS["bdd"]->prepare("SELECT reserver.id_membre as 'id_membre', date_debut_periode, date_fin_periode FROM membre,reserver WHERE reserver.id_membre = membre.id_membre AND rang = ?");
    $rs->execute(array($r+1));
    return $rs;
}

function getRangPre($r){
    $rp = $GLOBALS["bdd"]->prepare("SELECT reserver.id_membre as 'id_membre', date_debut_periode, date_fin_periode FROM membre,reserver WHERE reserver.id_membre = membre.id_membre AND rang = ?");
    $rp->execute(array($r-1));
    return $rp;
}

function echangeResa($id1, $id2, $dated1, $datef1, $dated2, $datef2){
    $e = $GLOBALS["bdd"]->prepare("UPDATE `reserver` SET `id_membre` = ? WHERE `id_membre` = ? AND date_fin_periode = ? AND  date_debut_periode = ?");
    $e->execute(array($id1,$id2,$datef2,$dated2));

    $f = $GLOBALS["bdd"]->prepare("UPDATE `reserver` SET `id_membre` = ? WHERE `id_membre` = ? AND date_fin_periode = ? AND  date_debut_periode = ?");
    $f->execute(array($id2,$id1,$datef1,$dated1));
}
?>