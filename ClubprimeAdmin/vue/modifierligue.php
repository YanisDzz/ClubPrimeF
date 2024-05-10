<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier la ligue</title>
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

<html>


<body>

    <?php
    require_once(__DIR__ . '/../model/ClubModel.php');
    $joueurs = ClubModel::getAllJoueurs();


    ?>

    <?php
    $idJoueur = isset($_GET['id_joueur']) ? $_GET['id_joueur'] : null;

    if ($idJoueur) {
        $joueur = ClubModel::getJoueurById($idJoueur);
        if ($joueur) {
            $nom = $joueur['nom'];
            $photo = $joueur['photo_joueur'];
            $nombreMatchJoue = $joueur['nombre_match_joue'];
            $nombreButMarque = $joueur['nombre_but_marque'];
            $nombrePasseDecisive = $joueur['nombre_passe_decisive'];
    ?>

    <?php
        } else {
            echo "Joueur non trouvé.";
        }
    } 
    ?>



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

                        <?php
                        $idligue = isset($_GET['id']) ? $_GET['id'] : null;

                        if ($idligue) {
                            $ligue = ClubModel::getligueById($idligue);

                            if ($ligue) {
                                $nom = $ligue['nom'];
                                $photo = $ligue['photoLigue'];
                        ?>
                                <form action="../controller/liguecontroller.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $idligue; ?>">


                                    <label for="nom">Nom de la ligue</label>
                                    <input type="text" name="nom" value="<?php echo $nom; ?>" required><br>

                                    <label for="photo">Logo de la ligue</label><br>
                                    <input type="file" name="photo" accept="image/*"><br>

                                    <input type="submit" id="submitmodifjoueur" name="modifierligue" value="Modifier cette ligue">
                                </form>
                        <?php
                            } else {
                                echo "ligue non trouvé.";
                            }
                        } else {
                            echo "Veuillez sélectionner une ligue à modifier.";
                        }
                        ?>
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