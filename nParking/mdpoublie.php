<?php
session_start();
if (isset($_SESSION["id"])) {
    header('Location: index.php');
}
include('controller/membre.ctrl.php');
$o = 0;
$error = NULL;
if (isset($_POST["mdp"])) {

    $mail = htmlspecialchars($_POST["mail"]);


    $c = countMailMembre($mail);

    if ($c>0) {

        $newpass = stringRand(10);

        setNewMdpByMail($mail,$newpass);


        $o = 1;


    }else{
        $error = "Le compte n'existe pas";
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
        <?php
        if ($o==1) {
            ?>
            <div class="row">
                <div class="col-md-12 black">
                    <p>On supose l'envois du mail suivant à l'utilisateur :</p>
                    <br />
                    <br />
                    <p>suite a votre demande votre mot de passe a été regénéré<br />
                        votre noiuveau mot de passe est : <?php echo $newpass ?> <br />
                        Merci de le changer au plus vite</p>
                    <br />
                    <a href="index.php">retour</a>
                </div>
            </div>
            <?php
        }

        ?>
        <span style="color : red;">
        <?php
        echo $error;
        ?>
      </span>
    </center>
    <form class="form-signin" method="POST">
        <h1 class="form-signin-heading text-muted">Mot de passe oublié</h1>
        <input type="mail" name="mail" class="form-control" placeholder="Adresse e-mail" required="" autofocus="">
        <input type="submit"  class="btn btn-success" name="mdp" value="Renvoyez moi mon mot de passe">
    </form>
    <p align="center" >
        <a href="login.php" style="color : #0beee8;">Connexion</a>
    </p>
</div>
</body>
</html>