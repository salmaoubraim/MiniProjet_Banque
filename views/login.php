<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
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
  padding: 0 10px;
}

label {
  display: block;
  margin-top: 5px;
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
  font-size: 16px;
}

button:hover {
  background-color: #3b1592;
}
</style>
</head>
<body>
  <form method="post" action="CONTROLLERS/LoginController.php">
    <fieldset>
      <legend style="text-align:center"><h1>login</h1></legend>

      <label for="username">Username :</label>
      <input  type="text"  name="nom_utilisateur" required><br><br>

      <label for="password">Password :</label>
      <input  type="password"  name="mot_de_passe" required><br><br>

      <button  type="submit">Se connecter</button>
    </fieldset>
  </form>
</body>
</html>