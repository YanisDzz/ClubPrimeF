<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['options'])) {
    include("../model/bdconnexion.php");
    include("../model/clubModel.php");

    $model = new ClubModel(connexionPDO());
    $clubIds = $_POST['options'];
    foreach ($clubIds as $clubId) {
        $clubId = intval($clubId);
        $model->supprimerClub($clubId);
    }

    header('Location: ../index.php');
    exit();
} else {
    echo 'erreur';
}

?>
