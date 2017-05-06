<?php
$titre = "Places";
include("includes/pages/header.php");
include("controller/place.ctrl.php");
if ($_SESSION["adm"]!=1) {
    header('Location: index.php');
}

if (isset($_POST["desac"])) {
    deAcPlace($_POST["id"]);
}


if (isset($_POST["ac"])) {
    acPlace($_POST["id"]);
}

if (isset($_POST["add"])) {
    addPlaces($_POST["num"]);
}


?>
    <div class="row">
        <div class="col-md-12 black">

            <h3>Ajout d'une place</h3>

            <form method="POST">
                <input type="number" name="num" placeholder="Nombre de place a ajouter">
                <input type="submit" name="add" class="btn btn-success">
            </form>

            <?php

            $nbplaceparpage = 10;



            $totalpage=ceil(getNbPlace()/$nbplaceparpage);


            $pagea = 1;
            if (!isset($_GET["p"])) {
                header('Location: place_admin.php?p=1');
            }elseif ($_GET["p"]<1) {
                $pagea = 1;
            }else{
                $pagea = $_GET["p"];
            }
            $prems = ($pagea-1)*$nbplaceparpage;

            $places = getPlacesOfPage($prems,$nbplaceparpage);

            ?>

            <ul class="pagination">
                <?php
                for ($i=1; $i <=$totalpage ; $i++) {
                    ?>
                    <li <?php echo ($_GET["p"]==$i)?"class='active'":""; ?>><a href="?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
            </ul>
            <table class="table table-bordered">
                <tr>
                    <th>#</th><th>Numero</th><th>Actions</th><th>Historique</th>
                </tr>
                <?php
                foreach ($places as $place=>$pl) {

                    var_dump($place);
                    var_dump($pl);

                    ?>
                    <tr>
                        <td><?php echo $place["id_place"]; ?></td><td><?php echo $place["num_place"]; ?></td><td>
                            <form method="POST">
                                <input type='hidden' name='id' value='<?php echo $place['id_place']; ?>'>
                                <?php echo ($place["active_place"]==1)?"<input type='submit' name='desac' value='Desactiver' class='btn btn-warning'>":"<input type='submit' name='ac' value='Activer' class='btn btn-success'>";?>
                            </form>
                        </td>
                        <!-- <td> <a href="Historique_admin.php?place=<?php //echo $place["id_place"]; ?>"><button <?php//echo($hc["hcount"]<1)?"disabled=''":""; ?> class="btn btn-info">Historique de  la place</button></a></td> -->
                    </tr>
                    <?php
                }
                ?>
            </table>

            <ul class="pagination">
                <?php
                for ($i=1; $i <=$totalpage ; $i++) {
                    ?>
                    <li <?php echo ($pagea==$i)?"class='active'":""; ?>><a href="?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php

include("includes/pages/footer.php");


?>