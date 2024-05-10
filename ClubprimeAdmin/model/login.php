<?php
require_once 'bdconnexion.php';

class AdminModel {
    public function authenticateAdmin($username, $password) {
        $pdo = connexionPDO();
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }
}
?>
