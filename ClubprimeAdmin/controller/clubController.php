<?php

include(__DIR__ . "/../model/bdconnexion.php");
include(__DIR__ . "/../model/clubModel.php");

class ClubController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function afficherTousLesClubs() {
        $nomsClubs = $this->model->getNomsClubsOrderedByClassement();

    
        foreach ($nomsClubs as $nomClub) {
            sort($nomsClubs);
            $id = $this->getIdClubByNom($nomClub);
            $descClub = $this->model->getDescriptionClub($id);
            $anneeClub = $this->model->getAnneeClub($id);
            $ligueClub = $this->model->getLigueClub($id);
            $descStadeClub = $this->model->getDescStadeClub($id);
            $nomEntraineurClub = $this->model->getNomEntraineurClub($id);
            $classement = $this->model->getClassementClubs($id);
            $capitaine = $this->model->getNomCapitaine($id);
    
            echo "<tr>";
    
            echo "<td>$nomClub</td>";
            echo "<td>$descClub</td>";
            echo "<td>$anneeClub</td>";
            echo "<td>$ligueClub</td>";
            echo "<td>$descStadeClub</td>";
            echo "<td>$nomEntraineurClub</td>";
            echo "<td>$classement</td>";
            echo "<td>$capitaine</td>";
            echo "<td>";
            echo "<a href='vue/modifierclub.php?id=$id' class='edit' data-club-id='$id'><i class='material-icons' data-toggle='tooltip' title='Modifier'>&#xE254;</i></a>";
            echo "<a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-club-id='$id'><i class='material-icons' data-toggle='tooltip' title='Supprimer'>&#xE872;</i></a>";
            echo "</td>";
            echo "</tr>";     
        }
    }

        public function afficherToutesLesLigues() {
            try {
                $ligues = $this->model->getNomsLigues();
                return $ligues;
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }


    private function getIdClubByNom($nomClub) {
            return $this->model->getIdClubByNom($nomClub);
        }
    }

    ?>
