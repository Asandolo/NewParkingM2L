<?php

function getJours($date){
    switch (date("N",strtotime($date))){
        case 1:
            return "Lundi ";
            break;
        case 2:
            return "Mardi ";
            break;
        case 3:
            return "Mercredi ";
            break;
        case 4:
            return "Jeudi ";
            break;
        case 5:
            return"Vendredi ";
            break;
        case 6:
            return "Samedi ";
            break;
        case 7:
            return "Dimanche ";
            break;
    }
}

function getMois($date){
    switch (date("n",strtotime($date))){
        case 1:
            return "janvier ";
            break;
        case 2:
            return "février ";
            break;
        case 3:
            return "mars ";
            break;
        case 4:
            return "avril ";
            break;
        case 5:
            return"mais ";
            break;
        case 6:
            return "juin ";
            break;
        case 7:
            return "Juillet ";
            break;
        case 8:
            return "Aout ";
            break;
        case 9:
            return "Septembre ";
            break;
        case 10:
            return "Octobre ";
            break;
        case 11:
            return "Novembre ";
            break;
        case 12:
            return "Décembre ";
            break;
    }
}

?>