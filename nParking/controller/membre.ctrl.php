<?php

include ("data/membre.data.php");



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
?>