<?php
session_start();
require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['nom_utilisateur'];
    $password = $_POST['mot_de_passe'];

    $user = User::login($username, $password); // 👈 خزن معلومات المستخدم

    if ($user) {
        $_SESSION['user'] = $user; // 👈 خزن المعلومات فـ session
        header("Location: controllers/DashboardController.php");
        exit();
    } else {
        $error = "Identifiants invalides.";
    }
}

require_once '../views/login.php';
