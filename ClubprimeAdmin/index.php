<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('location: ./vue/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Club administrateur</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>

</head>

<?php
include("controller/clubController.php");
$model = new ClubModel(connexionPDO());
$controller = new ClubController($model);
?>


<body>

    <div class="navbar">
        <img class="logo" src="./ressources/logo.png" alt="Logo" width="40px">
        <h1>ClubPrime Administration</h1>
        <a href="./controller/logout.php">Se déconnecter</a>
    </div>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="liens">
                                <a href="./index.php">
                                    <h2>Gérer les clubs</h2>
                                </a>
                                <a href="./vue/gererjoueur.php">
                                    <h2>Gérer les joueurs</h2>
                                </a>
                                <a href="./vue/gererligue.php">
                                    <h2>Gérer les ligues</h2>
                                </a>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter un club</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Année création</th>
                            <th>Ligue</th>
                            <th>Description du stade</th>
                            <th>Entraîneur</th>
                            <th>Classement</th>
                            <th>Capitaine</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $model = new ClubModel(connexionPDO());
                        $controller = new ClubController($model);
                        $controller->afficherTousLesClubs();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="./controller/ajouterClub.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un club</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" class="form-control" name="nomClub" required>
                        </div>

                        <div class="form-group">
                            <label>Classement</label>
                            <input type="number" class="form-control" name="classement" min="1" required>
                        </div>



                        <div class="form-group">
                            <label>Année de création</label>
                            <input type="text" class="form-control" name="anneeCreation" pattern="\d{4}" title="Veuillez entrer exactement 4 chiffres">

                        </div>

                        <div class="form-group">
                            <label for="ligue">Ligue</label>
                            <select class="form-control" id="ligue" name="ligue" required>
                                <?php

                                $ligues = $controller->afficherToutesLesLigues();


                                foreach ($ligues as $ligue) {
                                    echo '<option value="' . htmlspecialchars($ligue) . '">' . htmlspecialchars($ligue) . '</option>';
                                }
                                ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <label>Entraîneur</label>
                            <input type="text" class="form-control" name="nomEntraineur" required >
                        </div>

                        <div class="form-group">
                            <label>Capitaine</label>
                            <input type="text" class="form-control" name="Capitaine" required>
                        </div>

                        <div class="form-group">
                            <label>Description du club</label>
                            <textarea class="form-control" name="descriptionClub" required></textarea>
                        </div>


                        <div class="form-group">
                            <label>Description du stade</label>
                            <textarea class="form-control" name="descriptionStade" required></textarea>
                        </div>


                        <div class="box">
                            <label for="Logo">Logo </label> <br>
                            <input type="file" name="Logo" required>
                        </div>


                        <div class="box">
                            <label for="Logo">photoStade </label> <br>
                            <input type="file" name="photoStade" required>
                        </div>


                        <div class="box">
                            <label for="Logo">photo de l'entraineur </label> <br>
                            <input type="file" name="photoentraineur" required>
                        </div>


                        <div class="box">

                            <label for="Logo">photo du capitaine </label> <br>
                            <input type="file" name="photocapitaine" required>

                        </div>

                        <div class="box">
                            <label for="Logo">photo de l'équipe </label> <br>
                            <input type="file" name="photoequipe" required>

                        </div>



                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                        <input type="submit" class="btn btn-success" value="Ajouter">
                    </div>



                </form>
            </div>
        </div>
    </div>

    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="./controller/supprimerClub.php">
                    <div class="modal-header">
                        <h4 class="modal-title">Supprimer un club</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer le club <span id="clubNameToDelete"></span> ?</p>
                        <p class="text-warning"><small>Cette action ne peut pas être annulée.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="clubIdToDelete" name="options[]">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                        <input type="submit" class="btn btn-danger" value="Supprimer">
                    </div>
                </form>
            </div>
        </div>
    </div>


    </div>
</body>

</html>