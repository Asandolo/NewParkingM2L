<?php
$titre = "Reservation";
include('includes/pages/header.php');
include('controller/reserver.ctrl.php');
include('controller/place.ctrl.php');

$m = getMembreById($_SESSION["id"]);

if (!(getPlaceMembre($m["id"])==null && $m["rang"]<=0))
    header('Location: index.php');

echo $m["id"];

reserver($_SESSION["id"]);

?>
<div class="row">
    <?php echo "DEBUG : ".$m["rang"]; ?>
    <div class="col-md-12 black">
        <p>Merci de votre réservation !</p>
        <a href="index.php">Retour</a>
    </div>
</div>
