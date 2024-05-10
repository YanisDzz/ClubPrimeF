<?php
include(__DIR__ . "/../model/bdconnexion.php");
include(__DIR__ . "/../model/clubModel.php");

class JoueurController {
    public function afficherJoueurs() {
        try {
            $joueurs = ClubModel::getAllJoueurs();
            if ($joueurs) {
                foreach ($joueurs as $joueur) {
                    echo '<div class="joueur">';

                    echo '<div class="infojoueur">';
                    echo "<p> " . $joueur['nom'] . "</p>";

                    $photoBase64 = base64_encode($joueur['photo_joueur']);
                    echo "<img src='data:image/jpeg;base64," . $photoBase64 . "' alt='Photo du joueur'>";
                    
                    echo '</div>';

             


                    echo '<div class="btnjoueur">';
                    echo '<a href="modifierjoueur.php?id_joueur=' . $joueur['id_joueur'] . '">Modifier</a>';
                    echo '<a href="supprimerjoueur.php?id_joueur=' . $joueur['id_joueur'] . '">Supprimer</a>';
                    echo '</div>';

                    echo "<hr>";

                    echo '</div>';
                }
            } else {
                echo "Aucun joueur trouvé.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }


    
    public function ajouterJoueur($nom, $photo, $nombreMatchJoue, $nombreButMarque, $nombrePasseDecisive) {
        try {
            if ($this->getNombreJoueurs() < 4) {
                $result = ClubModel::ajouterJoueur($nom, $photo, $nombreMatchJoue, $nombreButMarque, $nombrePasseDecisive);
                
                if ($result) {
                    header("Location: ../vue/gererjoueur.php");
                    exit();
                } else {
                    echo "Échec de l'ajout du joueur.";
                }
            } else {
                echo "Le nombre maximal de joueurs (4) a été atteint.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    private function getNombreJoueurs() {
        try {
            $result = ClubModel::getNombreJoueurs();
            return $result;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function modifierJoueur($id, $nom, $photo, $nombreMatchJoue, $nombreButMarque, $nombrePasseDecisive) {
        try {
            $result = ClubModel::modifierJoueur($id, $nom, $photo, $nombreMatchJoue, $nombreButMarque, $nombrePasseDecisive);
            if ($result) {
                header("Location: ../vue/confirmation.php");
                exit();
            } else {
                echo "Échec de la modification du joueur.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    

    public function supprimerJoueur($id) {
        try {
            $result = ClubModel::supprimerJoueur($id);
            if ($result) {
                header("Location: ../vue/confirmation.php");
                exit();
            } else {
                echo "Échec de la suppression du joueur.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    

    
    
}

if(isset($_POST['ajouterJoueur'])) {
    $nom = $_POST['nom'];
    $photo = file_get_contents($_FILES['photo']['tmp_name']);
    $nombreMatchJoue = $_POST['nombreMatchJoue'];
    $nombreButMarque = $_POST['nombreButMarque'];
    $nombrePasseDecisive = $_POST['nombrePasseDecisive'];

    $controller = new JoueurController();
    $controller->ajouterJoueur($nom, $photo, $nombreMatchJoue, $nombreButMarque, $nombrePasseDecisive);
}

if(isset($_POST['modifierJoueur'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $nombreMatchJoue = $_POST['nombreMatchJoue'];
    $nombreButMarque = $_POST['nombreButMarque'];
    $nombrePasseDecisive = $_POST['nombrePasseDecisive'];

    if (!empty($_FILES['photo']['tmp_name'])) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
    } else {
        $joueurExistante = ClubModel::getJoueurById($id);
        if ($joueurExistante) {
            $photo = $joueurExistante['photo_joueur'];
        } else {
            echo "Erreur lors de la récupération de la photo existante du joueur.";
            return;
        }
    }

    $controller = new JoueurController();
    $controller->modifierJoueur($id, $nom, $photo, $nombreMatchJoue, $nombreButMarque, $nombrePasseDecisive);



  
}


