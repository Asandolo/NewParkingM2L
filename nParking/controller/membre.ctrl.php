<?php

include ("data/membre.data.php");
include ('includes/Utils.php');
//include ("controller/place.ctrl.php");


//VERIFIE MAIL ET MOT DE PASSE
function isValid($mail, $psw){
	$psw = hashMdp($psw);
    $i = getInfoConnect($mail);
    $data = $i->fetch();
    if ($data["psw_membre"] == $psw){
        return true;
    }
    else{
    	return false;
    }
}


//VERIFIE SI LE MEMBRE A ÉTÉ VALIDÉ PAR UN ADMIN 
function isValidMembre($mail){
	$i = getInfoConnect($mail);
	$data = $i->fetch();
	if($data["valide_membre"] == 1){
		return true;
	}else{
		return false;
	}
	
}


function countMailMembre($mail){
	return countMailMembreData($mail);
}


function verifNewMdp($mail, $oldpsw){
	$o = getMdpMembreData($mail);
	$old = $o->fetch();
	if($old[0] == hashMdp($oldpsw)){
		return true;
	}
	return false;
}



function getNotValideMembre(){
	$notVal = selectNotValideMembre();
	$cnotVal = $notVal->rowCount();
	if($cnotVal == 0)
		return null;
	$notValide = array();
	$i=0;
	while($data = $notVal->fetch()){
		$notValide[$i] = array(
    		"id_membre" => $data["id_membre"], 
    		"mail_membre" => $data["mail_membre"],
    		"civilite_membre" =>$data["civilite_membre"],
    		"nom_membre" => $data["nom_membre"],
    		"prenom_membre" => $data["prenom_membre"],
    		"date_naiss_membre" => $data["date_naiss_membre"],
    		"adRue_membre" => $data["adRue_membre"],
    		"adCP_membre" => $data["adCP_membre"],
    		"adVille_membre" => $data["adVille_membre"],
    		"rang" => $data["rang"],
    		"valide_membre" => $data["valide_membre"],
    		"admin_membre" => $data["admin_membre"]
		);
		$i++; 
	}
	return $notValide;
}

function getValideMembre(){
	$Valide = selectValideMembre();
	$cValide = $Valide->rowCount();
	if($cValide == 0)
		return null;
	$Valides = array();
	$i=0;
	while($data = $Valide->fetch()){
		$Valides[$i] = array(
    		"id_membre" => $data["id_membre"], 
    		"mail_membre" => $data["mail_membre"],
    		"civilite_membre" =>$data["civilite_membre"],
    		"nom_membre" => $data["nom_membre"],
    		"prenom_membre" => $data["prenom_membre"],
    		"date_naiss_membre" => $data["date_naiss_membre"],
    		"adRue_membre" => $data["adRue_membre"],
    		"adCP_membre" => $data["adCP_membre"],
    		"adVille_membre" => $data["adVille_membre"],
    		"rang" => $data["rang"],
    		"valide_membre" => $data["valide_membre"],
    		"admin_membre" => $data["admin_membre"]
		);
		$i++; 
	}
	return $Valides;
}

// HASH Du MOT DE PASS
function hashMdp($psw) {


// FONCTION MINIMALISTE, prenez contact pour une fonction plus sécurisé

	return md5($psw);
}




function setProfil($id,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville){
	updateProfil($id,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville);
}


function setNewMdpByMail($mail,$psw){
	updateMdpByMail($mail,hashMdp($psw));
}

function setNewMdp($id,$psw){
	updateMdp($id,$psw);
}

//VERIFIE SI L'EMAIL EXISTE DÉJA
function isMailExiste($mail){
	$verif = mailExiste($mail);
	$verif->fetch();
	if($verif->rowCount() == 0){
		return true;
	}
	return false;
}


//CREATION D'UN MEMBRE
function createMembre($mail,$psw,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville){
	$psw = hashMdp($psw);
	createMembreData($mail,$psw,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville);
}


function getMembre($mail){
    $i = getInfoConnect($mail);
    $data = $i->fetch();
    $membre = array(
    	"id" => $data["id_membre"], 
    	"mail_membre" => $data["mail_membre"],
    	"civilite_membre" =>$data["civilite_membre"],
    	"nom_membre" => $data["nom_membre"],
    	"prenom_membre" => $data["prenom_membre"],
    	"date_naiss_membre" => $data["date_naiss_membre"],
    	"adRue_membre" => $data["adRue_membre"],
    	"adCP_membre" => $data["adCP_membre"],
    	"adVille_membre" => $data["adVille_membre"],
    	"rang" => $data["rang"],
    	"valide_membre" => $data["valide_membre"],
    	"admin_membre" => $data["admin_membre"]);
    return $membre;
}


function getMembreById($id){
	$i = getInfoConnectById($id);
    $data = $i->fetch();
    $membre = array(
    	"id" => $data["id_membre"], 
    	"mail_membre" => $data["mail_membre"],
    	"civilite_membre" =>$data["civilite_membre"],
    	"nom_membre" => $data["nom_membre"],
    	"prenom_membre" => $data["prenom_membre"],
    	"date_naiss_membre" => $data["date_naiss_membre"],
    	"adRue_membre" => $data["adRue_membre"],
    	"adCP_membre" => $data["adCP_membre"],
    	"adVille_membre" => $data["adVille_membre"],
    	"rang" => $data["rang"],
    	"valide_membre" => $data["valide_membre"],
    	"admin_membre" => $data["admin_membre"]);
    return $membre;
}


function affichePlace($mail){
	$ajd = date("Y-m-d");
	$tsajd = strtotime($ajd);  
	$user = getMembre($mail);
	$affiche = "";
	$place = getReserver($user["id"]);
	if (getPlaceMembre($user["id"])==null && $user["rang"]<=0) {
		$affiche = "<p style='font-size:20px'>Vous n'avez aucune place et n'etes pas dans la file d'atente</p>";
		$affiche .= "</br><form><a class='btn btn-danger' value='Reserver une place' href='reservation.php' />Reserver une place</a></form>";
	}elseif($user["rang"]<=0){
		if($place["date_fin_periode"]>=$ajd){
			if($place["date_debut_periode"]<=$ajd){


				$affiche = "<p style='font-size:20px'>Vous avez la place : <br /><strong>".$place["num_place"]."</strong></p>";
				$affiche .= "<p style='font-size:20px'>Jusqu'au: <br /><strong>".formatDate($place["date_fin_periode"])."</strong></p>";
			}
			else{


				$deb_resa_fr=formatDate($place['date_debut_periode']);
				$fin_resa_fr=formatDate($place['date_fin_periode']);
				$affiche = "<h2>Vous aurez la place : "."<br />".$place["num_place"]."</br> du ".$deb_resa_fr." au ".$fin_resa_fr."</h2>" ;
			}
		}
	}else{
		$affiche = "<p style='font-size:20px'>Vous avez le rang : <br /><strong>".$user["rang"]."</strong></p>";
	}
	return $affiche;
}




//////////////////////////////////////////////////////////
///////////// REQUETTES ADMINISTRATEUR ///////////////////
//////////////////////////////////////////////////////////

function getMembresAdmins(){
	$admins = selectAdmins();
	$i=0;
	$membres = array();
	while($data = $admins->fetch()){
		$membres[$i] = array(
			"id_membre" => $data["id_membre"], 
    		"mail_membre" => $data["mail_membre"],
    		"civilite_membre" =>$data["civilite_membre"],
    		"nom_membre" => $data["nom_membre"],
    		"prenom_membre" => $data["prenom_membre"],
    		"date_naiss_membre" => $data["date_naiss_membre"],
    		"adRue_membre" => $data["adRue_membre"],
    		"adCP_membre" => $data["adCP_membre"],
    		"adVille_membre" => $data["adVille_membre"],
    		"rang" => $data["rang"],
    		"valide_membre" => $data["valide_membre"]
    	);
		$i++;
    }
    return $membres;
}


function getHistMembre($id){
	return selectHistMembre($id);
}


function setNonAdmin($id){
	updateNonAdmin($id);
}

function setAdmin($id){
	updateAdmin($id);
}

function setNonValide($id){
	updateNonValide($id);
}

function setValide($id){
	updateValide($id);
}

function setDeleteMembre($id){
	deleteMembre($id);
}

function getIdByMail($mail){
    return getIdByMailData($mail);
}

function getAdmByMail($mail){
    return getAdmByMailData($mail);
}

function stringRand($car) {
$string = "";
$chaine = "abcdefghijklmnpqrstuvwxy1234567890";
srand((double)microtime()*1000000);
for($i=0; $i<$car; $i++) {
$string .= $chaine[rand()%strlen($chaine)];
}
return $string;
}


function setNewRandMdp($id,$psw){
	$hashpsw = hashMdp($psw);
	updateMdp($id,$hashpsw);
}
?>