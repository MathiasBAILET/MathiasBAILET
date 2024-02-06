<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Connexion à la base de données
$nom_serveur = "localhost";
$utilisateur = "root";
$mdp ="";
$nom_base_données ="projet_objet";
$con = mysqli_connect($nom_serveur , $utilisateur ,$mdp , $nom_base_données);

// Création d'un nouvel objet Spreadsheet 
$spreadsheet = new Spreadsheet();

// Récupération des données de la base de données
$result = mysqli_query($con , "SELECT * FROM utilisateurs");

// Ajout des données dans le fichier Excel
$rowNumber = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $col = 'A';
    foreach($row as $cell) {
        $spreadsheet->getActiveSheet()->setCellValue($col.$rowNumber,$cell);
        $col++;
    }
    $rowNumber++;
}

// Enregistrement du fichier Excel
$writer = new Xlsx($spreadsheet);
$writer->save('export_utilisateurs.xlsx');
?>