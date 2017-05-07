<?php
$titre = "Reservation";
include('includes/pages/header.php');
include('controller/reserver.ctrl.php');
include('controller/place.ctrl.php');

$m = getMembreById($_SESSION["id"]);

if (!(getPlaceMembre($m["id"])==null && $m["rang"]<=0))
    header('Location: index.php');

reserver($_SESSION["id"]);

?>
<div class="row">
    <div class="col-md-12 black">
        <p>Merci de votre réservation !</p>
        <a href="index.php">Retour</a>
    </div>
</div>
