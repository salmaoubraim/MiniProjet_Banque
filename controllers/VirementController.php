<?php
session_start();  // ضروري يكون أول سطر
require_once '../models/User.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../controllers/LoginController.php');
    exit();
}

$from = $_SESSION['user']['nom_utilisateur'];
$to = $_POST['to'];
$montant = (float) $_POST['montant'];

if (User::virement($from, $to, $montant)) {
    $_SESSION['user']['solde'] = User::getSolde($from); // ✅ تحديت السولدي
    header("Location: ../controllers/DashboardController.php");
    exit();
} else {
    $error = "Erreur lors du virement (utilisateur inexistant ou solde insuffisant)";
    include '../views/virement.php';
}
