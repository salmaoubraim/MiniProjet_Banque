<?php 
require_once __DIR__ . '/../config/database.php';

class User {
    public static function login($username, $password) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM banque WHERE nom_utilisateur = ? AND mot_de_passe = ?");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: false;
    }

    public static function getSolde($username) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT solde FROM banque WHERE nom_utilisateur = ?");
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['solde'] : 0;
    }

    public static function retrait($username, $montant) {
        $pdo = Database::connect();

        // Vérifier si l'utilisateur existe et a un solde suffisant
        $stmt = $pdo->prepare("SELECT solde FROM banque WHERE nom_utilisateur = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || $user['solde'] < $montant) {
            return false;
        }

        $stmt = $pdo->prepare("UPDATE banque SET solde = solde - ? WHERE nom_utilisateur = ?");
        return $stmt->execute([$montant, $username]);
    }

    public static function virement($from, $to, $montant) {
        $pdo = Database::connect();
        $pdo->beginTransaction();

        try {
            // Vérifier si les deux utilisateurs existent
            $stmt1 = $pdo->prepare("SELECT solde FROM banque WHERE nom_utilisateur = ?");
            $stmt1->execute([$from]);
            $fromUser = $stmt1->fetch(PDO::FETCH_ASSOC);

            $stmt2 = $pdo->prepare("SELECT solde FROM banque WHERE nom_utilisateur = ?");
            $stmt2->execute([$to]);
            $toUser = $stmt2->fetch(PDO::FETCH_ASSOC);

            if (!$fromUser || !$toUser || $fromUser['solde'] < $montant) {
                $pdo->rollBack();
                return false;
            }

            // Effectuer les opérations
            $stmt3 = $pdo->prepare("UPDATE banque SET solde = solde - ? WHERE nom_utilisateur = ?");
            $stmt4 = $pdo->prepare("UPDATE banque SET solde = solde + ? WHERE nom_utilisateur = ?");

            $stmt3->execute([$montant, $from]);
            $stmt4->execute([$montant, $to]);

            $pdo->commit();
            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }
}
