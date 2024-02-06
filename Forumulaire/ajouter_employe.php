<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un employé</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    <div class="container">
        <h2>Ajouter un employé</h2>
        <div class="add-employee-form">
            <form method="post">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required><br><br>
                
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required><br><br>
                
                <label for="age">Âge :</label>
                <input type="number" id="age" name="age" required><br><br>
                
                <input type="submit" value="Ajouter">
            </form>
        </div>
    </div>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ce code ne sera exécuté que si le formulaire a été soumis
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projet_objet";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];

    // Insérer les données dans la table employe
    $sql = "INSERT INTO employe (nom, prenom, age) VALUES ('$nom', '$prenom', $age)";

    if ($conn->query($sql) === TRUE) {
        // Récupérer l'ID de l'employé nouvellement inséré
        $id_employe = $conn->insert_id;

        // Insérer un nouveau badge pour cet employé
        $sql_badge = "INSERT INTO badge (id_employe) VALUES ($id_employe)";

        if ($conn->query($sql_badge) === TRUE) {
            // Mettre à jour l'employé avec l'ID du badge
            $sql_update_employe = "UPDATE employe SET id_badge = $id_employe WHERE id_employe = $id_employe";
            if ($conn->query($sql_update_employe) === TRUE) {
                echo '<div class="success-message">Employé ajouté avec succès et un nouveau badge a été créé.</div>';
            } else {
                echo '<div class="error-message">Erreur lors de la mise à jour de l\'employé : ' . $conn->error . '</div>';
            }
        } else {
            echo '<div class="error-message">Erreur lors de la création du badge pour l\'employé : ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="error-message">Erreur lors de l\'ajout de l\'employé : ' . $conn->error . '</div>';
    }

    $conn->close();
}
?>



</body>
</html>
