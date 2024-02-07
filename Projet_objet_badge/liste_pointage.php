<!DOCTYPE html>
<html>
<head>
    <title>Pointages</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
<div class="container">
    <h2>Liste des pointages</h2>
    <div class="sort-bar">
        <form method="post">
            <label for="order">Trier par date :</label>
            <select name="order" id="order">
                <option value="ASC">Croissant</option>
                <option value="DESC">Décroissant</option>
            </select>
            <input type="submit" value="Trier">
        </form>
        <form method="post">
            <label for="search">Rechercher par nom :</label>
            <input type="text" name="search" id="search" placeholder="Entrez le nom de l'employé">
            <input type="submit" value="Rechercher">
        </form>
        <a href="ajouter_employe.php" class="add-employee-button">Ajouter un employé</a>
    </div>

    <form class="sort-bar" method="post" action="export_excel.php">
        <input type="submit" name="export_excel" value="Envoyer les informations vers Excel">
    </form>

    <table>
        <tr>
            <th>Nom Employé</th>
            <th>ID Pointage</th>
            <th>Date et Heure de Pointage</th>
            <th>Action</th> <!-- Nouvelle colonne pour les actions -->
        </tr>
        <?php
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

        $order = isset($_POST['order']) ? $_POST['order'] : 'ASC';

        // Si la recherche est soumise, on utilise le nom pour filtrer les résultats
        $search_condition = isset($_POST['search']) ? "AND employe.nom LIKE '%" . $_POST['search'] . "%'" : '';

        $sql = "SELECT pointage.id_pointage, pointage.date_heure_pointage, employe.nom 
                FROM pointage 
                INNER JOIN employe ON pointage.id_badge = employe.id_badge
                WHERE 1 $search_condition
                ORDER BY pointage.date_heure_pointage $order";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["nom"]. "</td><td>" . $row["id_pointage"]. "</td><td>" . $row["date_heure_pointage"]. "</td><td><form method='post'><input type='hidden' name='id_pointage' value='". $row["id_pointage"]. "'><input type='submit' name='delete' value='Supprimer'></form></td></tr>";
            }
        } else {
            echo "0 results";
        }

        // Gestion de la suppression
        if(isset($_POST['delete'])) {
            $id_pointage_to_delete = $_POST['id_pointage'];
            $delete_sql = "DELETE FROM pointage WHERE id_pointage = $id_pointage_to_delete";
            if ($conn->query($delete_sql) === TRUE) {
                echo "Enregistrement supprimé avec succès.";
                // Actualiser la page après la suppression
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "Erreur lors de la suppression de l'enregistrement : " . $conn->error;
            }
        }

        $conn->close();
        ?>
    </table>

    <h2>Liste des employés</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>ID</th>
            <th>Âge</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "projet_objet";

        // Connexion à la base de données
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Requête SQL pour récupérer les informations sur les employés
        $sql = "SELECT id_employe, nom, prenom, age FROM employe";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Afficher chaque employé dans une ligne du tableau
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nom"] . "</td>";
                echo "<td>" . $row["prenom"] . "</td>";
                echo "<td>" . $row["id_employe"] . "</td>";
                echo "<td>" . $row["age"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Aucun employé trouvé.</td></tr>";
        }
        $conn->close(); // Fermer la connexion à la base de données
        ?>
    </table>
</div>
</body>
</html>
