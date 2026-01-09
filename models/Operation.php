<?php
require_once _DIR_ . '/../config/database.php';

class Operation
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function updateSolde($username, $montant, $type)
    {
        // أولاً: نجيب السولدي القديم
        $stmt = $this->pdo->prepare("SELECT solde FROM banque WHERE nom_utilisateur = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        $ancienSolde = $user['solde'];

        if ($type === 'depot') {
            $nouveauSolde = $ancienSolde + $montant;
        } elseif ($type === 'retrait') {
            if ($montant > $ancienSolde) {
                return 'insufficient'; // حالة عدم توفر الرصيد
            }
            $nouveauSolde = $ancienSolde - $montant;
        } else {
            return false; // نوع غير معروف
        }

        // ثانياً: نحدّث السولدي
        $update = $this->pdo->prepare("UPDATE banque SET solde = ? WHERE nom_utilisateur = ?");
        $success = $update->execute([$nouveauSolde, $username]);

        return $success ? $nou