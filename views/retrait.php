<!DOCTYPE html>
<html>
<head><title>Retrait</title>
<style>
 body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: white;
  margin: 0;
  font-family: Arial, sans-serif;
}

form {
  width: 100%;
  max-width: 350px;

}

fieldset {
  border: 2px solid black;
  padding: 20px;
  border-radius: 8px;
}

legend {
  font-size: 20px;
  font-weight: bold;
  padding: 0 10px;}

  label {
  display: block;
  margin-top: 1px;
  font-weight: bold;
}

input {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  margin-top: 20px;
  width: 100%;
  padding: 10px;
  background-color: #5F27CD;
  color: white;
  border: none;
  border-radius: 4px;
  font-weight: bold;
  cursor: pointer;
  font-size: 20px;
}

button:hover {
  background-color: #3b1592;
}
a{
   font-size:23px;
}

</style>

</head>
<body>
        <fieldset>
    <legend style="text-align:center"><h1>Retirer de l'argent</h1></legend>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="../controllers/RetraitController.php">
        <label>Montant:</label>
        <input type="number" name="montant" step="5" required><br><br>
        <button type="submit">Valider</button><br><br>
    </form>
    <a href="../controllers/DashboardController.php">Retour</a>

</body>
</html>