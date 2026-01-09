<?php
session_start();
require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['user']['nom_utilisateur'];
    $montant = $_POST['montant'];

    // Check if the user has enough balance
    $solde = User::getSolde($username);
    if ($solde >= $montant) {
        if (User::retrait($username, $montant)) {
            // Update user info in session after withdrawal
            $_SESSION['user']['solde'] = $solde - $montant;
            header('Location: ../controllers/DashboardController.php'); // Redirect to dashboard
            exit();
        } else {
            $error = "Erreur lors du retrait.";
        }
    } else {
        $error = "Solde insuffisant.";
    }
}

require_once '../views/retrait.php';
