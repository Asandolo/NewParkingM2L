<?php
$titre = "Gestion rang";
include('includes/pages/header.php');
include('controller/attente.ctrl.php');

if ($_SESSION["adm"]!=1)
    header('Location: index.php');

if (isset($_POST["plus"])){
    plus($_POST["r"],$_POST["id"]);
}

if (isset($_POST["moins"])){
    moins($_POST["r"],$_POST["id"]);
}

?>
<div class="row">
    <div class="col-md-12 black">
        <table class="table table-bordered">
            <tr>
                <td>NOM</td>
                <td>PRENOM</td>
                <td>RANG</td>
                <td>ACTIONS</td>
            </tr>
            <?php
            $srang = getAttente();

            $crang=getCompt();

            if ($crang<1) {
                ?>
                <tr>
                    <td colspan="4">Pas de membre en fil d'attente</td>
                </tr>
                <?php
            }


            foreach ($srang as $drang) {
                ?>
                <tr>
                    <td><?php echo $drang["nom_membre"]; ?></td>
                    <td><?php echo $drang["prenom_membre"]; ?></td>
                    <td><?php echo $drang["rang"]; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $drang['id_membre']; ?>">
                            <input type="hidden" name="r" value="<?php echo $drang['rang']; ?>">
                            <input type="submit" name="plus" <?php echo (getMax()==$drang["rang"])?"disabled=''":""; ?> value="+" class="btn btn-success">
                            <input type="submit" name="moins" <?php echo ($drang["rang"]==1)?"disabled=''":""; ?> value="-" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
                <?php
            }

            ?>
        </table>
    </div>
</div>
<?php include('includes/pages/footer.php'); ?>