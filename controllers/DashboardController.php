<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: LoginController.php');
    exit();
}

$user = $_SESSION['user']; // L'utilisateur qui est connecté
$username = $user['nom_utilisateur'];
$solde = $user['solde']; // Solde mis à jour dans session

require_once '../views/dashboard.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="font-size:30px">
    
</body>
</html>