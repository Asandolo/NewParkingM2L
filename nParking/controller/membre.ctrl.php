<?php

include ("data/membre.data.php");
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

// HASH Du MOT DE PASS
function hashMdp($psw) {


// FONCTION MINIMALISTE, prenez contact pour une fonction plus sécurisé

	return md5($psw);
}


function verifNewMdp($mail, $mdp){
	$psw = getMdpMembreData($mail);
	$oldMdp = $psw->fetch();
	$mdp = hashMdp($mdp);
	if($oldMdp["psw_membre"] == $mdp){
		return true;
	}
	return false;

}


function setNewMdp($mail,$psw){
	$psw = hashMdp($psw);
	updateMdp($mail,$psw);
}

function setProfil($id,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville){
	updateProfil($id,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville);
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



function affichePlace($mail){
	$ajd = date("Y-m-d");
	$tsajd = strtotime($ajd);  
	$user = getMembre($mail);
	$affiche = "";
	$place = getReserver($user["id"]);
	if (getPlaceMembre($user["id"])==null && $user["rang"]<=0) {
		$affiche = "<p style='font-size:20px'>Vous n'avez aucune place et n'etes pas dans la file d'atente</p>";
		$affiche .= "</br><form><a class='btn btn-danger' value='Reserver une place' href='place_dispo.php' />Reserver une place</a></form>";
	}elseif($user["rang"]<=0){
		if($place["date_fin_periode"]>=$ajd){
			if($place["date_debut_periode"]<=$ajd){ 	
				$affiche = "<p style='font-size:20px'>Vous avez la place : <br /><strong>".$place["num_place"]."</strong></p>";
			}
			else{
				$deb_resa_fr=date("d/m/Y", strtotime($place['date_debut_periode'])) ;
				$fin_resa_fr=date("d/m/Y", strtotime($place['date_fin_periode'])) ;
				$affiche = "<h2>Vous avez la place : "."<br />".$place["num_place"]."</br> du ".$deb_resa_fr." au ".$fin_resa_fr."</h2>" ;
			}
		}
	}else{
		$affiche = "<p style='font-size:20px'>Vous avez le rang : <br /><strong>".$user["rang"]."</strong></p>";
		$affiche .= "</br><form><a class='btn btn-danger' value='Reserver une place' href='place_dispo.php' />Reserver une place</a></form>";
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

function setNonAdmin($id){
	updateNonAdmin($id);
}

function setAdmin($id){
	updateAdmin($id);
}

function setNonValide($id){
	updateNonAdmin($id);
}

function setValide($id){
	updateAdmin($id);
}

function setDeleteMembre($id){
	deleteMembre($id);
}

function getIdByMail($mail){
    getIdByMailData($mail);
}

function getAdmByMail($mail){
    return getAdmByMailData($mail);
}
?>