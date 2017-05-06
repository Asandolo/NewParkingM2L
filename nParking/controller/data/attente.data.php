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
?>