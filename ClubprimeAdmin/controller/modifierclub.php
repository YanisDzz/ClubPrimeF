<?php
include_once('../model/bdconnexion.php');
include_once('../model/clubModel.php');

$db = connexionPDO();
$model = new ClubModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modifierClub'])) {
        // Récupération des données du formulaire
        $clubId = $_POST['clubId'];
        $nouveauNom = $_POST['nouveauNom'];
        $ancienClub = $model->getClubById($clubId);

        // Garder les anciennes valeurs pour les champs non modifiés
        $nouvelleDescription = $ancienClub['descr'];
        $nouvelleAnneeCreation = $ancienClub['anneeCrea'];
        $nouvelleDescription = $_POST['nouvelleDescription'];
        $nouvelleAnneeCreation = $_POST['nouvelleAnneeCreation'];
        $nouvelleLigue = $_POST['nouvelleLigue'];
        $nouvelleDescriptionStade = $_POST['nouvelleDescription'];
        $nouveauEntraineur = $_POST['nouveauEntraineur'];
        $nouveauCapitaine = $_POST['nouveauCapitaine'];
        $nouveauClassement = $_POST['nouveauClassement'];

        // Récupération des images blob
        $photoStadeBlob = !empty($_FILES['photoStade']['tmp_name']) ? file_get_contents($_FILES['photoStade']['tmp_name']) : $ancienClub['photoStade'];
        $photoEntraineurBlob = !empty($_FILES['photoEntraineur']['tmp_name']) ? file_get_contents($_FILES['photoEntraineur']['tmp_name']) : $ancienClub['photo_entraineur'];
        $photoCapitaineBlob = !empty($_FILES['photoCapitaine']['tmp_name']) ? file_get_contents($_FILES['photoCapitaine']['tmp_name']) : $ancienClub['photo_capitaine'];
        $photoEquipeBlob = !empty($_FILES['photoEquipe']['tmp_name']) ? file_get_contents($_FILES['photoEquipe']['tmp_name']) : $ancienClub['photo_equipe'];
        $logoclubBlob = !empty($_FILES['logoclub']['tmp_name']) ? file_get_contents($_FILES['logoclub']['tmp_name']) : $ancienClub['logo'];

        // Appel de la méthode de modification dans le modèle avec les données et les images blob
        $result = $model->modifierClub(
            $clubId,
            $nouveauNom,
            $nouvelleDescription,
            $nouvelleAnneeCreation,
            $nouvelleLigue,
            $nouvelleDescriptionStade,
            $nouveauEntraineur,
            $nouveauClassement,
            $nouveauCapitaine,
            $photoStadeBlob,
            $photoEntraineurBlob,
            $photoCapitaineBlob,
            $photoEquipeBlob,
            $logoclubBlob
        );

        if ($result === true) {
            header('Location: ../vue/confirmation.php');
            exit();
        } else {
            echo "Erreur lors de la modification du club: $result";
        }
    }
}

$ligues = $model->getAllLeagues();
?>
