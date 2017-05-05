<?php
include("config/db.php");

function getInfoConnect($mail){
    $info = $GLOBALS["bdd"]->prepare("SELECT * FROM membre WHERE mail_membre = ?");
    $info->execute(array($mail));
    return $info;
}

function MailExiste($mail){
	$verif=$GLOBALS["bdd"]->prepare("SELECT mail_membre AS  FROM membre WHERE mail_membre=?");
  	$verif->execute(array($mail));
  	return $verif;
}

function createMembreData($mail,$hashpsw,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville){
	$r = $GLOBALS["bdd"]->prepare("INSERT INTO `membre` (`mail_membre`, `psw_membre`, `civilite_membre`, `nom_membre`, `prenom_membre`, `date_naiss_membre`, `adRue_membre`, `adCP_membre`, `adVille_membre`, `rang`, `valide_membre`, `admin_membre`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, '0', '0', '0')");
    $r->execute(array($mail,$hashpsw,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville));
}

function getIdByMail($mail){
    $r = $GLOBALS["bdd"]->prepare("SELECT id FROM membre WHERE mail_membre = ?");
    $r->execute(array($mail));
    $d = $r ->fetch();
    return $d["id"];
}

function getMdpMembreData($mail){
	$verif =$GLOBALS["bdd"]->prepare("SELECT psw_membre FROM membre WHERE mail_membre = ?");
	$verif->execute(array($mail));
	return $verif;
}


function updateMdp($mail,$psw){
	$updatepsw = $GLOBALS["bdd"]->prepare("UPDATE membre SET psw_membre = ? WHERE mail_membre = ?");
	$updatepsw->execute(array($psw,$mail));
}

function updateProfil($id,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville){
	$update = $GLOBALS["bdd"]->prepare("
		UPDATE membre 
		SET civilite_membre = ?, nom_membre = ?, prenom_membre = ?, date_naiss_membre = ?, adRue_membre = ?, adCP_membre = ?, adVille_membre = ? 
		WHERE id_membre =  ?");
	$update->execute(array($civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville,$id));
}



//////////////////////////////////////////////////////////
///////////// REQUETTES ADMINISTRATEUR ///////////////////
//////////////////////////////////////////////////////////


function selectAdmins(){
	$admins = $GLOBALS["bdd"]->prepare("SELECT * FROM `membre` WHERE `admin_membre` = ?;");
	$admins->execute(array(1));
	return $admins;
}


function updateNonAdmin($id){
	$deladm = $GLOBALS["bdd"]->prepare("UPDATE `membre` SET `admin_membre` = 0 WHERE `id_membre` = ?");
	$deladm->execute(array($id));
}


function updateAdmin($id){
	$deladm = $GLOBALS["bdd"]->prepare("UPDATE `membre` SET `admin_membre` = 1 WHERE `id_membre` = ?");
	$deladm->execute(array($id));
}

function updateNonValide($id){
	$deladm = $GLOBALS["bdd"]->prepare("UPDATE `membre` SET `valide_membre` = 0 WHERE `id_membre` = ?");
	$deladm->execute(array($id));
}


function updateValide($id){
	$deladm = $GLOBALS["bdd"]->prepare("UPDATE `membre` SET `valide_membre` = 1 WHERE `id_membre` = ?");
	$deladm->execute(array($id));
}

function deleteMembre($id){
	$deladm = $bdd->prepare("DELETE FROM `membre` WHERE `id_membre` = ?");
	$deladm->execute(array($id));
}
?>