<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('location: ./vue/login.php');
    exit();
}
?>

<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit();
}


$clubId = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier club</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <?php include_once('../controller/modifierclub.php'); ?>
    <?php
    $club = $model->getClubById($clubId);
    if ($club) {
        $ancienNom = $club['nom'];
        $ancienneDescription = $club['descr'];
        $ancienneAnneeCreation = $club['anneeCrea'];
        $ancienneLigue = $club['idLigue'];
        $ancienneDescriptionStade = $club['descrStade'];
        $ancienEntraineur = $club['entraineur'];
        $ancienClassement = $club['classement'];
        $ancienNomCapitaine = $club['nom_capitaine'];
    }
    ?>





</body>

</html>



<body>

    <div class="navbar">
        <img class="logo" src="../ressources/logo.png" alt="Logo" width="40px">
        <h1>ClubPrime Administration</h1>
        <a href="../controller/logout.php">Se déconnecter</a>
    </div>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="liens">
                                <a href="../index.php">
                                    <h2>Gérer les clubs</h2>
                                </a>
                                <a href="../vue/gererjoueur.php">
                                    <h2>Gérer les joueurs</h2>
                                </a>
                                <a href="../vue/gererligue.php">
                                    <h2>Gérer les ligues</h2>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <tbody>
                        <form action="../controller/modifierclub.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="nomClub" value="<?php echo htmlspecialchars($ancienNom); ?>">
                            <input type="hidden" name="clubId" value="<?php echo $clubId; ?>">

                            <label for="nouveauNom">Nouveau nom :</label>
                            <input type="text" name="nouveauNom" id="nouveauNom" value="<?php echo htmlspecialchars($ancienNom); ?>"><br><br>

                            <label for="nouveauClassement">Nouveau classement :</label>
                            <input type="number" name="nouveauClassement" id="nouveauClassement" value="<?php echo htmlspecialchars($ancienClassement); ?>"><br><br>

                            <label for="nouvelleDescription">Nouvelle description :</label><br>
                            <textarea name="nouvelleDescription" id="nouvelleDescription"><?php echo htmlspecialchars($ancienneDescription); ?></textarea><br><br>

                            <label for="nouvelleAnneeCreation">Nouvelle année de création :</label>
                            <input type="number" name="nouvelleAnneeCreation" id="nouvelleAnneeCreation" value="<?php echo htmlspecialchars($ancienneAnneeCreation); ?>"><br><br>


                            <label for="nouvelleLigue">Nouvelle ligue :</label>
                            <select name="nouvelleLigue" id="nouvelleLigue">
                                <?php
                                $ligues = $model->getAllLeagues();

                                foreach ($ligues as $ligue) {
                                    echo "<option value='" . $ligue['id'] . "'";
                                    if ($ligue['id'] == $ancienneLigue) {
                                        echo " selected";
                                    }
                                    echo ">" . htmlspecialchars($ligue['nom']) . "</option>";
                                }
                                ?>
                            </select><br><br>

                            <label for="nouveauEntraineur">Nouveau nom de l'entraîneur :</label>
                            <input type="text" name="nouveauEntraineur" id="nouveauEntraineur" value="<?php echo htmlspecialchars($ancienEntraineur); ?>"><br><br>

                            <label for="nouveauCapitaine">Nouveau nom du capitaine :</label>
                            <input type="text" name="nouveauCapitaine" id="nouveauCapitaine" value="<?php echo htmlspecialchars($ancienNomCapitaine); ?>"><br><br>

                            <label for="photoStade">Photo du stade :</label> <br>
                            <input type="file" name="photoStade" id="photoStade"><br><br>

                            <label for="photoEntraineur">Photo de l'entraîneur :</label> <br>
                            <input type="file" name="photoEntraineur" id="photoEntraineur"><br><br>

                            <label for="photoCapitaine">Photo du capitaine :</label> <br>
                            <input type="file" name="photoCapitaine" id="photoCapitaine"><br><br>

                            <label for="photoEquipe">Photo de l'équipe :</label> <br>
                            <input type="file" name="photoEquipe" id="photoEquipe"><br><br>

                            <label for="logoclub">Nouveau logo :</label> <br>
                            <input type="file" name="logoclub" id="logoclub"><br><br>






                            <button type="submit" name="modifierClub">Modifier</button>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="../controller/joueurcontroller.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">


                    </div>

                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                        <input type="submit" class="btn btn-success" name="ajouterJoueur" value="Ajouter">
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>