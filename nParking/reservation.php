<?php
$titre = "Reservation";
include('includes/pages/header.php');
include('controller/reserver.ctrl.php');
include('controller/place.ctrl.php');

$m = getMembreById($_SESSION["id"]);

if (!(getPlaceMembre($m["id"])==null && $m["rang"]<=0))
    header('Location: index.php');

if(isset($_POST["OUI"])){
	setRang($_SESSION["id"]);
	header('Location: index.php');
}

if(reserver($_SESSION["id"]) == null){
	?>
	<div class="row">
    <div class="col-md-12 black">

	<p>Il n'y a plus de place disponnible pour le moment, souhaitez vous être mis en file d'attente ?</p>

	<form method="POST">
		<input type="submit" value="OUI" class="btn btn-success" name="OUI">
	</form>
	<a href="index.php"><button class="btn btn-danger">NON</button></a></div></div>
	<?php
}
else{
?>
<div class="row">
    <div class="col-md-12 black">
        <p>Merci de votre réservation !</p>
        <a href="index.php">Retour</a>
    </div>
</div>
<?php
}
?>