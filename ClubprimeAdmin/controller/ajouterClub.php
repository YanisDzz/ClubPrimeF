<?php
include_once('../model/bdconnexion.php');
include_once('../model/clubModel.php');

$db = connexionPDO();
$model = new ClubModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nomClub'];
    $descr = $_POST['descriptionClub'];
    $anneeCrea = $_POST['anneeCreation'];
    $nomLigue = $_POST['ligue'];
    $descrStade = $_POST['descriptionStade'];
    $entraineur = $_POST['nomEntraineur'];
    $nomCapitaine = $_POST['Capitaine'];
    $classement = $_POST['classement'];
    
    if ($model->clubExisteAvecClassement($classement)) {
        echo "Erreur : Un autre club a déjà le classement choisi. Veuillez choisir un autre classement.";
        echo '<br><a href="javascript:history.go(-1)">Retour en arrière</a>';
        exit();
    }
    if (isset($_FILES['Logo']['tmp_name']) && !empty($_FILES['Logo']['tmp_name'])) {
        $logoContent = file_get_contents($_FILES['Logo']['tmp_name']);
    } else {
        echo "Erreur : le fichier Logo n'a pas été correctement téléchargé.";
        echo '<br><a href="javascript:history.go(-1)">Retour en arrière</a>';
        exit();
    }

    $photoStadeContent = file_get_contents($_FILES['photoStade']['tmp_name']);
    $photoentraineurContent = file_get_contents($_FILES['photoentraineur']['tmp_name']);
    $photocapitaineContent = file_get_contents($_FILES['photocapitaine']['tmp_name']);
    $photoequipeContent = file_get_contents($_FILES['photoequipe']['tmp_name']);
    
    $idLigue = $model->getIdLigueByNom($nomLigue);
    $result = $model->ajouterClub($nom, $logoContent, $descr, $anneeCrea, $idLigue, $descrStade, $photoStadeContent, $entraineur, $classement, $photoentraineurContent, $nomCapitaine, $photocapitaineContent, $photoequipeContent);
    
    if ($result == true){
    header('Location: ../index.php');
    }


}
?>
