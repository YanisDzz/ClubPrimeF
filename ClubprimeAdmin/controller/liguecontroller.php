<?php
include(__DIR__ . "/../model/bdconnexion.php");
include(__DIR__ . "/../model/clubModel.php");

class ligueController {
    public function afficherLigues() {
        try {
            $ligues = ClubModel::getAllLigues();
            if ($ligues) {
                foreach ($ligues as $ligue) {

                    echo '<div class="wrapligue">';

                    echo '<div class="ligue">';
                    echo "<p>Nom : " . $ligue['nom'] . "</p>";

                     $photoBase64 = base64_encode($ligue['photoLigue']);
                    echo "<img src='data:image/jpeg;base64," . $photoBase64 . "' alt='Photo du joueur'>";

                    echo '</div>';

                    echo '<div class="btnligue">';
                    echo '<a href="modifierligue.php?id=' . $ligue['id'] . '">Modifier</a>';
                    echo '<a href="supprimerligue.php?id=' . $ligue['id'] . '">Supprimer</a>';
                    echo '</div>';

                    echo '</div>';

                }
            } else {
                echo "Aucune ligue trouvé.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function ajouterligue($nom, $photo) {
        try {
                $result = ClubModel::ajouterligue($nom, $photo);
                
                if ($result) {
                    header("Location: ../vue/confirmation.php");
                    exit();
                } else {
                    echo "Échec de l'ajout de la ligue.";
                }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function modifierligue($nom, $photo, $id) {
        try {
            $ancienneLigue = ClubModel::getLigueById($id);
            if (!$ancienneLigue) {
                echo "La ligue spécifiée n'existe pas.";
                return;
            }
            
            if (empty($photo)) {
                $photo = $ancienneLigue['photoLigue'];
            }
    
            $result = ClubModel::modifierligue($nom, $photo, $id);
            if ($result) {
                header("Location: ../vue/confirmation.php");
                exit();
            } else {
                echo "Échec de la modification de la ligue.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    
    

    public function supprimerLigue($id) {
        try {
            $result = ClubModel::supprimerligue($id);
            if ($result) {
                header("Location: ../vue/confirmation.php");
                exit();
            } else {
                echo "Échec de la suppression de la ligue.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}

if(isset($_POST['ajouterligue'])) {
    $nom = $_POST['nom'];
    $photo = file_get_contents($_FILES['photo']['tmp_name']);
    $controller = new ligueController();
    $controller->ajouterligue($nom, $photo);
}


if (isset($_POST['modifierligue'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $photo = (!empty($_FILES['photo']['tmp_name'])) ? file_get_contents($_FILES['photo']['tmp_name']) : null;

    $controller = new ligueController();
    $controller->modifierligue($nom, $photo, $id);
}
