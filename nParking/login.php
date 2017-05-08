<?php
session_start();
if (isset($_SESSION["mail"])) {
  header('Location: index.php');
}

include("controller/membre.ctrl.php");
include("controller/reserver.ctrl.php");
trier();

if(isset($_POST["conect"]))
{
  $mail= $_POST["mail"];
  $psw = $_POST["psw"];
  if (isValid($mail,$psw)) {
     
    if(isValidMembre($mail))
    {
      $_SESSION["mail"] = $mail;
      $_SESSION["id"] = getIdByMail($mail);
      $_SESSION["adm"] = getAdmByMailData($mail);
      header('Location: index.php');
    }
    else
    {
      $error = "Votre compte n'est pas activé";
    }

  }else{
    $error = "Erreur de saisie de l'email ou du mot de passe";
  }

}  
?>




<!DOCTYPE html>
<html>
<head>
  <title>LOGIN</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="includes/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="includes/css/login.css">
  
<script type="text/javascript" src="includes/js/jq.js"></script>
<script type="text/javascript" src="includes/js/bootstrap.js"></script>
</head>
<body>
  <div id="fullscreen_bg" class="fullscreen_bg"/>

  <div class="container">
    <center>
      <span style="color : red;">
        <?php
        echo (isset($error))?$error:"";
        ?>
      </span>
    </center>
    <form class="form-signin" method="POST">
      <h1 class="form-signin-heading text-muted">Connexion</h1>
      <input type="text" name="mail" class="form-control" placeholder="Adresse e-mail" required="" autofocus="">
      <input type="password" name="psw" class="form-control" placeholder="Mot de Passe" required="">
      <input class="btn btn-lg btn-primary btn-block" type="submit" value="Se connecter" name="conect">
    </form>
    <p align="center" >
      <a href="register.php" style="color : #0beee8;">S'enregistrer</a>
      <a href="mdpoublie.php" style="color : #0beee8;">Mot de passe oublié</a>
    </p>    
  </div>
</body>
</html>