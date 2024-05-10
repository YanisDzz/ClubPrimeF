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

    <div class="navbar">
        <img class="logo" src="../ressources/logo.png" alt="Logo" width="40px">
        <h1>ClubPrime Administration</h1>
        <a href="../controller/logout.php">Se déconnecter</a>
    </div>


    <div class="card-succ">
    <dotlottie-player src="https://lottie.host/45e7510c-d1b1-4afe-8b4f-d929667b1356/7oXjM5Ytcj.lottie" background="transparent" speed="1" style="width: 200px; height: 200px;"  autoplay></dotlottie-player>
        <p>Action réalisé avec succès</p>
        <a href="../index.php">Revenir vers les équipes</a>
        <a href="../vue/gererligue.php">Revenir vers les ligues</a>
        <a href="../vue/gererjoueur.php">Revenir vers les joueurs</a>
    </div>

    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

</body>

</html>