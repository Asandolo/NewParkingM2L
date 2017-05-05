<?php
session_start();
if (isset($_SESSION["mail"])) {
  header('Location: index.php');
}
include("controller/membre.ctrl.php");
$error= NULL ;
$ok= NULL ;
if(isset($_POST['enregistrer']))
{
  $mail = htmlspecialchars($_POST['mail']);
  $psw = htmlspecialchars($_POST['psw']);
  $ckpsw = htmlspecialchars($_POST['check_psw']);
  $nom = htmlspecialchars($_POST['nom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $rue = htmlspecialchars($_POST['rue']);
  $cp = htmlspecialchars($_POST['cp']);
  $ville = htmlspecialchars($_POST['ville']);
  $civilite = htmlspecialchars($_POST['civilite']);
  
  $jour_naiss = htmlspecialchars($_POST['jour']);
  $mois_naiss = htmlspecialchars($_POST['mois']);
  $anne_naiss = htmlspecialchars($_POST['annee']);

  $date_naiss = $anne_naiss."-".$mois_naiss."-".$jour_naiss;

  if(!isMailExiste($mail))
  {
    $error = "Adresse e-mail déjà utilisé";
  }
  else if ($psw!=$ckpsw) 
  {
    $error = "Mot de passe différent de la vérification";
  }
  else
  {
  	createMembre($mail,$psw,$civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville);
  	$ok = "Vos informations on bien été enreistrés vous pourez vous connecter quand votre compte aura été valider par un administrateur";
  }
}  
?>


<!DOCTYPE html>
<html>
<head>
  <title>REGISTER</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="includes/css/bootstrap.css"> 
  <link rel="stylesheet" type="text/css" href="includes/css/login.css">
 
<script type="text/javascript" src="includes/js/jq.js"></script>
<script type="text/javascript" src="includes/js/bootstrap.js"></script>
</head>
<body>
  

  <div class="container">
    <center>
      <span style="color : red;">
        <?php
        echo $error;
        ?>
      </span>    
      <span style="color : #7FFF00;">
        <?php
        echo $ok;
        ?>
      </span>
    </center>
    <form class="form-signin" method="POST">
      <h1 class="form-signin-heading text-muted">S'enregistrer</h1>
      <input type="mail" name="mail" class="form-control" placeholder="Adresse e-mail" required="" autofocus=""></br>
      <input type="password" name="psw" class="form-control" placeholder="Mot de Passe" required=""></br>
      <input type="password" name="check_psw" class="form-control" placeholder="Confirmer mot de passe" required=""></br>
      <label style="color : #0beee8;"></label><select type="text" name="civilite" class="form-control" placeholder="civilité" required="">
      <option>
        Mr.
      </option>
      <option>
        Mme.
      </option>
    </select></br>
    <input type="text" name="nom" class="form-control" placeholder="nom" required=""></br>
    <input type="text" name="prenom" class="form-control" placeholder="Prénom" required=""></br>
    <label style="color : #0beee8;">Jour</label><select name="jour" class="form-control" required="">
    <?php
    for ($i=1;$i<=31;$i++) {
      ?>
      <option>
        <?php
        echo $i;
        ?>    
      </option>
      <?php
    }
    ?>
  </select>
  <label style="color : #0beee8;">Mois</label><select name="mois" class="form-control" required="">
  <?php
  for ($i=1;$i<=12;$i++) {
    ?>
    <option>
      <?php
      echo $i;
      ?>    
    </option>
    <?php
  }
  ?>
</select>
<label style="color : #0beee8;">Année</label><select name="annee" class="form-control" required="">
<?php
for ($i=Date("Y");$i>=1920;$i--) {
  ?>
  <option>
    <?php
    echo $i;
    ?>    
  </option>
  <?php
}
?>
</select></br>  
<input type="text" name="rue" class="form-control" placeholder="Adresse" required=""></br>
<input type="text" name="cp" class="form-control" placeholder="Code Postal" required=""></br>
<input type="text" name="ville" class="form-control" placeholder="Ville" required=""></br>
<input class="btn btn-lg btn-primary btn-block" type="submit" value="S'enregistrer" name="enregistrer"></br>
</form>
<p align="center" >
  <a href="login.php" style="color : #0beee8;">Se connecter</a>
</p>    

</body>
</html>