<?php
// inscription.php
if(isset($_POST['nom_utilisateur']) && isset($_POST['mot_de_passe'])) {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $nom_serveur = "localhost";
    $utilisateur = "root";
    $mot_de_passe_db ="";
    $nom_base_données ="projet_objet";
    $con = mysqli_connect($nom_serveur , $utilisateur ,$mot_de_passe_db , $nom_base_données);

    // Hash the password before storing
    $req = mysqli_query($con , "INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe) VALUES ('$nom_utilisateur', '$mot_de_passe')");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="" method="post">
    <label for="nom_utilisateur">Nom d'utilisateur:</label>
    <input type="text" id="nom_utilisateur" name="nom_utilisateur"><br>
    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" id="mot_de_passe" name="mot_de_passe">
    <input type="submit" value="Inscription" class="button">
</form>

<div class="button-container">
       <a href="index.php" class="pointage">Connexion</a>
</div>
</body>
</html>