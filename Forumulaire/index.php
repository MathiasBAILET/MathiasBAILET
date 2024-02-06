<?php 
 //Nous allons démarrer la session avant toute chose
   session_start() ;
  if(isset($_POST['boutton-valider'])){ // Si on clique sur le boutton , alors :
    //Nous allons verifiér les informations du formulaire
    if(isset($_POST['nom_utilisateur']) && isset($_POST['mot_de_passe'])) { //On verifie ici si l'utilisateur a rentré des informations
      //Nous allons mettres l'nom_utilisateur et le mot de passe dans des variables
      $nom_utilisateur = $_POST['nom_utilisateur'] ;
      $mot_de_passe = $_POST['mot_de_passe'] ;
      $erreur = "" ;
       //Nous allons verifier si les informations entrée sont correctes
       //Connexion a la base de données
       $nom_serveur = "localhost";
       $utilisateur = "root";
       $mdp ="";
       $nom_base_données ="projet_objet" ;
       $con = mysqli_connect($nom_serveur , $utilisateur ,$mdp , $nom_base_données);
       //requete pour selectionner  l'utilisateur qui a pour nom_utilisateur et mot de passe les identifiants qui ont été entrées
        $req = mysqli_query($con , "SELECT * FROM utilisateurs WHERE nom_utilisateur = '$nom_utilisateur' AND mot_de_passe ='$mot_de_passe' ") ;
        $num_ligne = mysqli_num_rows($req) ;//Compter le nombre de ligne ayant rapport a la requette SQL
        if($num_ligne > 0){
            header("Location:liste_pointage.php") ;//Si le nombre de ligne est > 0 , on sera redirigé vers la page bienvenu
            // Nous allons créer une variable de type session qui vas contenir l'nom_utilisateur de l'utilisateur
            $_SESSION['nom_utilisateur'] = $nom_utilisateur ;
        }else {//si non
            $erreur = "Nom d'utilisateur ou Mots de passe incorrectes ⚠️";
        }
    }
  }

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
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <section>
       <h1> Connexion</h1>
       <?php 
       if(isset($erreur)){// si la variable $erreur existe , on affiche le contenu ;
           echo "<p class= 'Erreur'>".$erreur."</p>"  ;
       }
       ?>
       <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
           <label>Nom d'utilisateur</label>
           <input type="text" name="nom_utilisateur">
           <label >Mots de Passe</label>
           <input type="password" name="mot_de_passe">
           <input type="submit" value="Valider" name="boutton-valider">
       </form>
       <div class="button-container">
       <a href="inscr.php" class="inscription">Inscription</a>
</div>
   </section> 
</body>
</html>