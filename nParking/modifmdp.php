<?php
$titre = "Modif Mot de passe";
include("includes/pages/header.php");

if (!isset($_GET["id"]) || empty($_GET["id"])) {
	header('Location: index.php');	
}else{
	$psw = stringRand(10);
	setNewrandMdp($_GET["id"],$psw);
}

?>
<div class="row">
	<div class="col-md-12 black">
		<p>On supose l'envois du mail suivant à l'utilisateur :</p>
		<br />
		<br />
		<p>suite a votre demande votre mot de passe a été regénéré<br />
			votre noiuveau mot de passe est : <?php echo $psw ?> <br />
			Merci de le changer au plus vite</p>
			<br />
			<a href="index.php">retour</a>
		</div>
	</div>
	<?php
	include("includes/pages/footer.php");
	?>