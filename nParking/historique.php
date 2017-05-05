<?php 
$titre = "Historique";
include("includes/pages/header.php");
include("controller/reserver.ctrl.php");
?>


<div class="row">
	<div class="col-md-12 black">
		<p><center>HISTORIQUE</center></p>
	</div>
	<div class="col-md-12 black">
		<p>
			<center>
				<?php
				$aujourdhui = date("Y-m-d");
				$tsajd = strtotime($aujourdhui);
				$user = getMembre($_SESSION["mail"]);
				
				?>
				<table class="table table-bordered">
					<tr>
						<th>NUMERO DE PLACE</th>
						<th>DATE D'ATTRIBUTION</th>
						<th>DATE D'EXPIRATION</th>
						<th>Etat Actuel</th>
					</tr>
					<?php
					$d = getHistoriqueMembre($user["id"]);
					var_dump($d);
					foreach($d as $donnee) 
					{
							$debut = strtotime($donnee['date_debut_periode']);
							$fin = strtotime($donnee['date_fin_periode']);
							?>
							<tr>
								<td><?php echo $donnee['num_place'];?></td>
								<td><?php echo date("d/m/Y",$debut);?></td>
								<td><?php echo date("d/m/Y",$fin);?></td>
								<td><?php echo ($debut <= $tsajd && $fin >= $tsajd)?"<span 	style='color:green;'>Actuelle</span>":"<span style='color:red;'>Expirée</span>";?></td>
							</tr>
							<?php
						
					}
					?>
				</table>
			</center>
		</p>
	</div>
</div>
<?php include("includes/pages/footer.php");?>