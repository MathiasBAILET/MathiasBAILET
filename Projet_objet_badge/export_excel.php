<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet_objet";

// Créer une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données à exporter
$sql = "SELECT employe.nom, pointage.id_pointage, pointage.date_heure_pointage
        FROM pointage
        INNER JOIN employe ON pointage.id_badge = employe.id_badge";
$result = $conn->query($sql);

// Créer un fichier Excel
$filename = "export_pointages_" . date('Y-m-d') . ".xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

// Entête du fichier Excel
echo "Nom Employé\tID Pointage\tDate et Heure de Pointage\n";

// Boucler à travers les données et les écrire dans le fichier Excel
while($row = $result->fetch_assoc()) {
    echo $row["nom"] . "\t" . $row["id_pointage"] . "\t" . $row["date_heure_pointage"] . "\n";
}

$conn->close();
exit;
?>
