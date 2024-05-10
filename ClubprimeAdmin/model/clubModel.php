<?php
require_once(__DIR__ . '/bdconnexion.php');

class ClubModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ajouterClub($nom, $logo, $descr, $anneeCrea, $idLigue, $descrStade, $photoStade, $entraineur, $classement, $photoEntraineur, $nomCapitaine, $photoCapitaine, $photoEquipe)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO club (nom, logo, descr, anneeCrea, idLigue, descrStade, photoStade, entraineur, classement, photo_entraineur, nom_capitaine, photo_capitaine, photo_equipe) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bindParam(1, $nom);
            $stmt->bindParam(2, $logo);
            $stmt->bindParam(3, $descr);
            $stmt->bindParam(4, $anneeCrea);
            $stmt->bindParam(5, $idLigue);
            $stmt->bindParam(6, $descrStade);
            $stmt->bindParam(7, $photoStade);
            $stmt->bindParam(8, $entraineur);
            $stmt->bindParam(9, $classement);
            $stmt->bindParam(10, $photoEntraineur);
            $stmt->bindParam(11, $nomCapitaine);
            $stmt->bindParam(12, $photoCapitaine);
            $stmt->bindParam(13, $photoEquipe);

            $stmt->execute();

            $stmt->closeCursor();

            return "Club ajouté avec succès!";
        } catch (PDOException $e) {
            return "Erreur lors de l'ajout du club: " . $e->getMessage();
        }
    }


    public function clubExisteAvecClassement($classement)
    {
        $query = "SELECT COUNT(*) FROM club WHERE classement = :classement";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':classement', $classement, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return $count > 0;
    }
    

    public function getNomsLigues()
    {
        $query = "SELECT nom FROM ligue";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    public function getIdClubByNom($nomClub)
    {
        $query = "SELECT id FROM club WHERE nom = :nomClub";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":nomClub", $nomClub, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    }


    public function getNomsClubs()
    {
        $query = "SELECT nom FROM club";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getClassementClubs($id)
    {
        $query = "SELECT classement FROM club WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function getnomcapitaine($id)
    {
        $query = "SELECT nom_capitaine FROM club WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }


    public function getNomsClubsOrderedByClassement()
{
    $query = "SELECT nom FROM club ORDER BY classement ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

    

    public function getDescriptionClub($id)
    {
        $query = "SELECT descr FROM club WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['descr'];
    }

    public function getAnneeClub($id)
    {
        $query = "SELECT anneeCrea FROM club WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['anneeCrea'];
    }

    public function getLigueClub($id)
    {
        $query = "SELECT idLigue FROM club WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $idLigue = $stmt->fetch(PDO::FETCH_ASSOC)['idLigue'];

        if ($idLigue !== false) {

            $queryLigue = "SELECT nom FROM ligue WHERE id = :idLigue";
            $stmtLigue = $this->db->prepare($queryLigue);
            $stmtLigue->bindParam(":idLigue", $idLigue, PDO::PARAM_INT);
            $stmtLigue->execute();

            $result = $stmtLigue->fetch(PDO::FETCH_ASSOC);
            if ($result !== false) {
                return $result['nom'];
            } else {

                return "Ligue non trouvée";
            }
        } else {

            return "Club non trouvé";
        }
    }

    public function getIdLigueByNom($nomLigue)
    {
        $query = "SELECT id FROM ligue WHERE nom = :nomLigue";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":nomLigue", $nomLigue, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    }
    public function getDescStadeClub($id)
    {
        $query = "SELECT descrStade FROM club WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['descrStade'];
    }

    public function getNomEntraineurClub($id)
    {
        $query = "SELECT entraineur FROM club WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['entraineur'];
    }

    public function supprimerClub($id)
    {
        $query = "DELETE FROM club WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }


    public static function ajouterJoueur($nom, $photo, $nombreMatchJoue, $nombreButMarque, $nombrePasseDecisive) {
        try {
            $conn = connexionPDO();
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO joueur (nom, photo_joueur, nombre_match_joue, nombre_but_marque, nombre_passe_decisive) VALUES (?, ?, ?, ?, ?)");

            $stmt->bindParam(1, $nom);
            $stmt->bindParam(2, $photo, PDO::PARAM_LOB);
            $stmt->bindParam(3, $nombreMatchJoue);
            $stmt->bindParam(4, $nombreButMarque);
            $stmt->bindParam(5, $nombrePasseDecisive);

            $stmt->execute();
            $conn->commit();

            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            throw $e;
        }
    }

    public static function getNombreJoueurs() {
        try {
            $conn = connexionPDO();
            $stmt = $conn->query("SELECT COUNT(*) FROM joueur");
            $count = $stmt->fetchColumn();
            return $count;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public static function modifierJoueur($id, $nom, $photo, $nombreMatchJoue, $nombreButMarque, $nombrePasseDecisive) {
        try {
            $conn = connexionPDO();
            $conn->beginTransaction();
    
            $stmt = $conn->prepare("UPDATE joueur SET nom=?, photo_joueur=?, nombre_match_joue=?, nombre_but_marque=?, nombre_passe_decisive=? WHERE id_joueur=?");
    
            $stmt->bindParam(1, $nom);
            $stmt->bindParam(2, $photo, PDO::PARAM_LOB);
            $stmt->bindParam(3, $nombreMatchJoue);
            $stmt->bindParam(4, $nombreButMarque);
            $stmt->bindParam(5, $nombrePasseDecisive);
            $stmt->bindParam(6, $id);
    
            $stmt->execute();
            $conn->commit();
    
            return true;
        } catch (PDOException $e) {
            $conn->rollBack();
            throw $e;
        }
    }
    

    public static function getJoueurById($id) {
    try {
        $conn = connexionPDO();
        $stmt = $conn->prepare("SELECT * FROM joueur WHERE id_joueur = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw $e;
    }
}


public static function getAllJoueurs() {
    try {
        $conn = connexionPDO();
        $stmt = $conn->query("SELECT * FROM joueur");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw $e;
    }
}
    
public static function supprimerJoueur($id) {
    try {
        $conn = connexionPDO();
        $stmt = $conn->prepare("DELETE FROM joueur WHERE id_joueur = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        throw $e;
    }
}

public static function getAllLigues() {
    try {
        $conn = connexionPDO();
        $stmt = $conn->query("SELECT * FROM ligue");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw $e;
    }
}

public static function supprimerligue($id) {
    try {
        $conn = connexionPDO();
        $stmt = $conn->prepare("DELETE FROM ligue WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        throw $e;
    }
}
    

public static function ajouterligue($nom, $photo) {
    try {
        $conn = connexionPDO();
        $conn->beginTransaction();
        $stmt = $conn->prepare("INSERT INTO ligue (nom, photoLigue) VALUES (?, ?)");

        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $photo, PDO::PARAM_LOB);

        $stmt->execute();
        $conn->commit();

        return true;
    } catch (PDOException $e) {
        $conn->rollBack();
        throw $e;
    }
}


public static function modifierligue($nom, $photo, $id) {
    try {
        $conn = connexionPDO();
        $conn->beginTransaction();

        $stmt = $conn->prepare("UPDATE ligue SET nom=?, photoLigue=? WHERE id=?");

        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $photo, PDO::PARAM_LOB);
        $stmt->bindParam(3, $id);

        $stmt->execute();
        $conn->commit();

        return true;
    } catch (PDOException $e) {
        $conn->rollBack();
        throw $e;
    }
}



public static function getligueById($id) {
    try {
        $conn = connexionPDO();
        $stmt = $conn->prepare("SELECT * FROM ligue WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw $e;
    }
}


public function modifierClub($clubId, $nouveauNom, $descriptionClub, $anneeCreation, $idLigue, $descriptionStade, $nomEntraineur, $classement, $nomCapitaine, $photoStadeBlob, $photoEntraineurBlob, $photoCapitaineBlob, $photoEquipeBlob, $logoclubBlob) {
    try {
        $this->db->beginTransaction();

        // Préparation de la requête SQL
        $stmt = $this->db->prepare("UPDATE club SET nom = ?, descr = ?, anneeCrea = ?, idLigue = ?, descrStade = ?, entraineur = ?, classement = ?, nom_capitaine = ?, photoStade = ?, photo_entraineur = ?, photo_capitaine = ?, photo_equipe = ?, logo = ? WHERE id = ?");

        // Liaison des paramètres
        $stmt->bindParam(1, $nouveauNom);
        $stmt->bindParam(2, $descriptionClub);
        $stmt->bindParam(3, $anneeCreation);
        $stmt->bindParam(4, $idLigue);
        $stmt->bindParam(5, $descriptionStade);
        $stmt->bindParam(6, $nomEntraineur);
        $stmt->bindParam(7, $classement);
        $stmt->bindParam(8, $nomCapitaine);
        $stmt->bindParam(9, $photoStadeBlob, PDO::PARAM_LOB);
        $stmt->bindParam(10, $photoEntraineurBlob, PDO::PARAM_LOB);
        $stmt->bindParam(11, $photoCapitaineBlob, PDO::PARAM_LOB);
        $stmt->bindParam(12, $photoEquipeBlob, PDO::PARAM_LOB);
        $stmt->bindParam(13, $logoclubBlob, PDO::PARAM_LOB);
        $stmt->bindParam(14, $clubId);

        // Exécution de la requête
        $stmt->execute();

        // Engagement de la transaction
        $this->db->commit();

        return true;
    } catch (PDOException $e) {
        // En cas d'erreur, annuler la transaction
        $this->db->rollBack();
        return "Erreur lors de la modification du club: " . $e->getMessage();
    }
}


public function getClubById($id)
{
    try {
        $query = "SELECT * FROM club WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw $e;
    }
}

public function getAllLeagues()
{
    try {
        $query = "SELECT * FROM ligue";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw $e;
    }
}





}
