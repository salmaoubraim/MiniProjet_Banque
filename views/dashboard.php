<?php

if (!isset($_SESSION['user'])) {
    header("Location: ../controllers/LoginController.php");
    exit();
}

$username = $_SESSION['user']['nom_utilisateur'];
$nom = $_SESSION['user']['nom'];
$solde = $_SESSION['user']['solde'];
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Bienvenue, <?php echo htmlspecialchars($username); ?> !</h2>
    <p>Votre solde est : <strong><?php echo htmlspecialchars($solde); ?> MAD</strong></p>

   <a href="../views/virement.php">Faire un virement</a><br>
   <a href="../views/retrait.php">Effectuer un retrait</a><br>
   <a href="LogoutController.php">Se déconnecter</a>
</body>
</html>
