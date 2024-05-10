<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('location: ../vue/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Club administrateur</title>
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

<?php
include("../controller/liguecontroller.php");
$model = new ClubModel(connexionPDO());
$controller = new ligueController($model);
?>


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
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter une ligue</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
       
                    <tbody>
                        <?php
                        $model = new ClubModel(connexionPDO());
                        $controller = new ligueController($model);
                        $controller->afficherLigues();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    


    <div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../controller/liguecontroller.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter une ligue</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
      
                    <div class="form-group">
                        <label>logo de la ligue</label>
                        <div class="custom-file">
                        <input type="file" name="photo" accept="image/*" required><br>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Annuler">
                    <input type="submit" class="btn btn-success" name="ajouterligue" value="Ajouter">
                </div>
                
            </form>
        </div>
    </div>
</div>


    </div>
</body>

</html>