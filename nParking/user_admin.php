<?php
$titre = "Utilisateurs Admin";
include("includes/pages/header.php");

if ($_SESSION["adm"]!=1) {
    header('Location: index.php');
}

if (isset($_POST["degrade"])) {
	setNonAdmin($_POST["id"]);
}

if (isset($_POST["admin"])) {
	setAdmin($_POST["id"]);
}

if (isset($_POST["deac"])) {
	
	setNonValide($_POST["id"]);
}

if (isset($_POST["activate"])) {
	setValide($_POST["id"]);
}

if (isset($_POST["sup"]) || isset($_POST["refu"])) {
	setDeleteMembre($_POST["id"]);
}
?>
<div class="row">
	<div class="col-md-12 black" style="overflow: auto;">
		<center>
			<h2>Gestion des membres</h2>
			<h3>Administrateurs</h3>
			<table class="table table-bordered">
				<tr>
					<th>#</th>
					<th>Civilite</th>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Place/rang</th>
					<th>Actions</th>
				</tr>
				<?php

				$admins = getMembresAdmins();
				$cadmins = Count($admins);

				if ($cadmins == 0) {
					?>
					<td colspan="12">Il n'y a pas de membre dans cette section</td>
					<?php
				}else{
					foreach($admins as $admin){
						$ajd = date("Y-m-d"); 
						$tsajd = strtotime($ajd);
						$placesadmin = getReserver($admin["id_membre"]);
						?>
						<tr>
							<td><?php echo $admin["id_membre"]; ?></td>
							<td><?php echo $admin["civilite_membre"]; ?></td>
							<td><?php echo $admin["nom_membre"]; ?></td>
							<td><?php echo $admin["prenom_membre"]; ?></td>
							<td><?php

							if ($placesadmin["num_place"] == null && $admin["rang"]<=0) {
								echo "/";
							}elseif($admin["rang"]<=0){
								echo "Place :".$placesadmin["num_place"];
							}else{
								echo "Rang : ".$admin["rang"];
							}

							?></td>
							<td>
								<form method="POST">
									<input type="hidden" name="id" value="<?php echo $admin["id_membre"]; ?>">
									<input type="submit" value="Rétrograder" class="btn btn-danger" name="degrade" <?php echo ($cadmins == 1 || $admin["id_membre"] == $_SESSION["id"])?"disabled=''":"" ?>>
								</form>
								<a href="modif_admin.php?id=<?php echo $admin["id_membre"]; ?>"><button class="btn btn-success">Mofifier</button></a>
							</td>
						</tr>
						<?php
					}
				}

						?>
			</table>
		</center>
	</div>
	<div class="col-md-12 black" style="overflow: auto;">
		<center>
			<h3>Non vérifié</h3>
			<table class="table table-bordered">
				<tr>
					<th>#</th>
					<th>Civilite</th>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Actions</th>
				</tr>
				<?php
				$nonverifs = getNotValideMembre();
				if ($nonverifs == null) {	
					?>
					<td colspan="12">Il n'y a pas de membre dans cette section</td>
					<?php
				}else{
					foreach($nonverifs as $nonverif){
						$placesnonverif = getReserver($nonverif["id_membre"]);
						?>
						<tr>
							<td><?php echo $nonverif["id_membre"]; ?></td>
							<td><?php echo $nonverif["civilite_membre"]; ?></td>
							<td><?php echo $nonverif["nom_membre"]; ?></td>
							<td><?php echo $nonverif["prenom_membre"]; ?></td>
							<td><?php 
								if ($placesnonverif["num_place"] == null && $nonverif["rang"]<=0) {
									echo "/";
								}elseif($nonverif["rang"]<=0){
									echo "Place :".$placenonverif["num_place"];
								}else{
									echo "Rang : ".$nonverif["rang"];
								}
								?></td>
								<td>
									<form method="POST">
										<input type="hidden" name="id" value="<?php echo $nonverif["id_membre"]; ?>">
										<input type="submit" name="activate" value="Activer" class="btn btn-success">
									</form>
									<form method="POST">
										<input type="hidden" name="id" value="<?php echo $nonverif["id_membre"]; ?>">
										<input type="submit" name="refu" value="Refuser" class="btn btn-danger">
									</form>
									<a href="modif_admin.php?id=<?php echo $nonverif["id_membre"]; ?>"><button class="btn btn-success">Mofifier</button></a>
								</td>
							</tr>
							<?php
						}}
						?>
			</table>
		</center>
	</div>
	<div class="col-md-12 black" style="overflow: auto;">
		<center>
			<h3>Vérifié</h3>
			<table class="table table-bordered">
				<tr>
					<th>#</th>
					<th>Civilite</th>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Place/rang</th>
					<th>Admin</th>
					<th>Actions</th>
				</tr>
				<?php
				$verifs = getValideMembre();
				if ($verifs == null) {
					?>
					<td colspan="12">Il n'y a pas de membre dans cette section</td>
					<?php
				}else{
					foreach($verifs as $verif){
						$histcount = getHistMembre($verif["id_membre"]);
						$placesverif = getReserver($verif["id_membre"]);
						?>
						<tr>
							<td><?php echo $verif["id_membre"]; ?></td>
							<td><?php echo $verif["civilite_membre"]; ?></td>
							<td><?php echo $verif["nom_membre"]; ?></td>
							<td><?php echo $verif["prenom_membre"]; ?></td>
							<td><?php 
								if ($verif["id_membre"] == null && $verif["rang"]<=0) {
									echo "/";
								}elseif($verif["rang"]<=0){
									echo "Place :".$placesverif["num_place"];
								}else{
									echo "Rang : ".$verif["rang"];
								}
							?>	
							</td>
							<td><?php echo ($verif["admin_membre"] == 1)?"<span style='color:green;'>Oui</span>":"<span style='color:red;'>Non</span>"; ?></td>
							<td>
								<form method="POST">
									<input type="hidden" name="id" value="<?php echo $verif["id_membre"]; ?>">
									<input type="submit" name="deac" class="btn btn-warning" value="Désactiver" <?php echo ($verif["admin_membre"] == 1 || $verif["id_membre"] == $_SESSION["id"])?"disabled=''":"" ?>>
								</form>
								<form method="POST">
									<input type="hidden" name="id" value="<?php echo $verif["id_membre"]; ?>">
									<input type="submit" name="admin" class="btn btn-info" value="Grader admin" <?php echo ($verif["admin_membre"] == 1)?"disabled=''":"" ?>>
								</form>
								<form method="POST">
									<input type="hidden" name="id" value="<?php echo $verif["id_membre"]; ?>">
									<input type="submit" name="sup" class="btn btn-danger" value="Supprimer" <?php echo ($verif["admin_membre"] == 1)?"disabled=''":"" ?>>
								</form>
								<a href="modif_admin.php?id=<?php echo $verif["id_membre"]; ?>"><button class="btn btn-success">Modifier</button></a>
								<a href="historique_admin.php?user=<?php echo $verif['id_membre']; ?>"><button class="btn btn-info" <?php echo($histcount<1)?"disabled=''":""; ?>>Historique place</button></a>
							</td>
						</tr>
						<?php
					}
				}
						?>
			</table>
		</center>
	</div>
</div>
<?php
include("includes/pages/footer.php");
?>