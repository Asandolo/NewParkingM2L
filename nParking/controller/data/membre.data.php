<?php
include("config/db.php");

function getInfoConnect($mail){
    $info = $GLOBALS["bdd"]->prepare("SELECT * FROM membre WHERE mail_membre = ?");
    $info->execute(array($mail));
    return $info;
}

function MailExiste($mail){
	$verif=$GLOBALS["bdd"]->prepare("SELECT mail_membre AS  FROM membre WHERE mail_membre=?");
  	$verif->execute($mail);
  	return $verif;
}

function createMembreData($mail,$hashpsw,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville){
	$r = $GLOBALS["bdd"]->prepare("INSERT INTO `membre` (`id_membre`, `mail_membre`, `psw_membre`, `civilite_membre`, `nom_membre`, `prenom_membre`, `date_naiss_membre`, `adRue_membre`, `adCP_membre`, `adVille_membre`, `rang`, `valide_membre`, `admin_membre`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', '0', '0')");
    $r->execute(array($mail,$hashpsw,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville));
}
?>